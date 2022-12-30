<?php
namespace Tests\Feature\Http\Controllers\Admin;
use App\Models\Interest;
use HttpResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase{
    use RefreshDatabase;

    private User $user;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->admin = $this->createUser(is_admin: true);
    }

    public function test_it_redirects_to_login_page_if_user_is_not_authenticated() {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
    }

    public function test_it_displays_a_list_of_users_if_authenticated()
    {
        #Arrange
        User::factory(1)->create(['name' => 'DummyDumDum']);

        #Act
        $response = $this->actingAs($this->user)->get('/users');

        #Assert
        $response->assertOk();
        $response->assertSee('Kontaks');
        $response->assertSee('DummyDumDum');
    }

    public function test_non_admin_cannot_see_admin_action_buttons_in_users_table()
    {
        #Arrange
        #Act
        $response = $this->actingAs($this->user)->get('/users');

        #Assert
        $response->assertOk();
        $response->assertSee('Kontaks');
        $response->assertDontSee('Delete');
    }

    public function test_non_admin_can_see_edit_action_button_in_users_table()
    {
        #Arrange
        $user = User::firstWhere('is_admin', false);

        #Act
        $response = $this->actingAs($user)->get('/users');

        #Assert
        $response->assertOk();
        $response->assertSee('Kontaks');
        $response->assertSee('Edit');
    }

    public function test_admin_can_see_admin_action_buttons_in_users_table()
    {

        #Arrange
        #Act
        $response = $this->actingAs($this->admin)->get('/users');

        #Assert
        $response->assertOk();
        $response->assertSee('Kontaks');
        $response->assertSee('Edit');
        $response->assertSee('Delete');
    }

    public function test_users_create_redirects_to_login_if_unauthenticated()
    {
        $response = $this->get('/users/create');

        $response->assertRedirect('/login');
    }

    public function test_users_create_returns_403_for_non_admin()
    {
        $response = $this->actingAs($this->user)->get('/users/create');

        $response->assertStatus(403);
        $response->assertSee('This action is unauthorized.');
    }

    public function test_admin_can_render_users_create_page()
    {
        $response = $this->actingAs($this->admin)->get('/users/create');

        $response->assertOk();
        $response->assertSee('Kontak Details');
    }

    public function test_admin_can_create_a_user()
    {
        Interest::factory(5)->create();

        $response = $this->actingAs($this->admin)->post('/users', [
            'language_id' => 1,
            'name' => 'Serina Snow',
            'surname' => 'Levine',
            'za_id_number' => '975',
            'birth_date' => '2003-04-11',
            'mobile_number' => '+1 (295) 252-7817',
            'email' => 'bypajasaz@mailinator.com',
            'interests' => [1,5]
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Serina Snow']);
        $response->assertRedirectToRoute('dashboard');
    }

    public function test_users_show_can_be_rendered()
    {
        $response = $this->actingAs($this->user)->get('/users/'.$this->user->id);

        $response->assertOk();
        $response->assertSeeText([$this->user->name, $this->user->surname]);
    }

    public function test_non_admin_can_see_edit_button_for_own_details_page()
    {
        $response = $this->actingAs($this->user)->get('/users/'.$this->user->id);

        $response->assertOk();
        $response->assertSeeText(['Edit']);
    }

    public function test_non_admin_cannot_see_admin_buttons_for_other_users_details_page()
    {
        $otherUser = User::factory()->create();

        $response = $this->actingAs($this->user)->get('/users/'.$otherUser->id);

        $response->assertOk();
        $response->assertDontSeeText(['Edit', 'Delete']);
    }

    public function test_admin_can_see_admin_buttons_for_other_users_details_page()
    {
        $otherUser = User::factory()->create();

        $response = $this->actingAs($this->admin)->get('/users/'.$otherUser->id);

        $response->assertOk();
        $response->assertSeeText(['Edit', 'Delete']);
    }

    public function test_admin_can_render_edit_page()
    {
        $response = $this->actingAs($this->admin)->get("users/{$this->admin->id}/edit");

        $response->assertOk();
        $response->assertSeeText($this->admin->name);
        $response->assertSeeText($this->admin->surname);
    }

    public function test_non_admin_can_render_own_edit_page()
    {
        $response = $this->actingAs($this->user)->get("users/{$this->user->id}/edit");

        $response->assertOk();
        $response->assertSeeText($this->user->name);
        $response->assertSeeText($this->user->surname);
    }

    public function test_non_admin_cannot_render_other_user_edit_page()
    {
        $otherUser = User::factory()->create();
        $response = $this->actingAs($this->user)->get("users/{$otherUser->id}/edit");

        $response->assertForbidden();
        $response->assertSeeText([403, 'This action is unauthorized.']);
    }

    public function test_admin_can_update_any_users_details()
    {
        $interests = Interest::factory(5)->create();
        $response = $this->actingAs($this->admin)->put("/users/{$this->user->id}", [
            'name' => 'Updated_Name',
            'surname' => 'Updated_Surname',
            'user_id' => $this->user->id,
            'language_id' => $this->user->language_id,
            'za_id_number' => $this->user->za_id_number,
            'birth_date' => $this->user->birth_date,
            'mobile_number' => $this->user->mobile_number,
            'email' => $this->user->email,
            'interests' => $interests->random(count($interests))]);

        $response->assertRedirect("/users/{$this->user->id}");
        $this->assertDatabaseHas('users', ['name' => 'Updated_Name', 'surname'=>'Updated_Surname']);
    }

    public function test_non_admin_can_update_own_details()
    {
        $interests = Interest::factory(5)->create();
        $response = $this->actingAs($this->user)->put("/users/{$this->user->id}", [
            'name' => 'Updated_Name2',
            'surname' => 'Updated_Surname2',
            'user_id' => $this->user->id,
            'language_id' => $this->user->language_id,
            'za_id_number' => $this->user->za_id_number,
            'birth_date' => $this->user->birth_date,
            'mobile_number' => $this->user->mobile_number,
            'email' => $this->user->email,
            'interests' => $interests->random(count($interests))]);

        $response->assertRedirect("/users/{$this->user->id}");
        $this->assertDatabaseHas('users', ['name' => 'Updated_Name2', 'surname'=>'Updated_Surname2']);
    }

    public function test_non_admin_cannot_update_other_users_details()
    {
        $otherUser = User::factory()->create();

        $response = $this->actingAs($this->user)->put("/users/{$otherUser->id}",
            ['name' => 'Updated_Name3', 'surname' => 'Updated_Surname3']);

        $response->assertForbidden();
        $response->assertSee(403, 'This action is unauthorized.');
    }

    public function test_admin_can_delete_user_successfully()
    {
        $deleteUser = User::factory()->create();

        $response = $this->actingAs($this->admin)->delete('/users/'.$deleteUser->id, ['id' => $deleteUser->id]);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('dashboard');
        $this->assertDatabaseMissing('users', $deleteUser->toArray());
    }

    public function test_non_admin_can_delete_own_profile_successfully()
    {
        $deleteUser = User::factory()->create();

        $response = $this->actingAs($deleteUser)->delete('/users/'.$deleteUser->id, ['id' => $deleteUser->id]);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('dashboard');
        $this->assertDatabaseMissing('users', $deleteUser->toArray());
    }

    public function test_non_admin_cannot_delete_other_user_profile_successfully()
    {
        $deleteUser = User::factory()->create();

        $response = $this->actingAs($this->user)->delete('/users/'.$deleteUser->id, ['id' => $deleteUser->id]);

        $response->assertForbidden();
        $response->assertSeeText([403, 'This action is unauthorized.']);
    }

    private function createUser(bool $is_admin = false): User
    {
        return User::factory()->create(['is_admin' => $is_admin]);
    }
}

