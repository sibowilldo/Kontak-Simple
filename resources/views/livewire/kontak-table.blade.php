<div>
    <div class="mb-5">
        <input wire:model.debounce.150ms="search" type="text" class="border-0 rounded shadow-sm" placeholder="Search Name...">
    </div>
    <section class="overflow-x-auto relative rounded-lg shadow-sm">
        <x-kontak-table :users="$users"/>
    </section>
    <footer>
        {{ $users->links() }}
    </footer>
</div>
