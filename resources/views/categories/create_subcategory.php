<x-app-layout>
    <x-slot name="header">
        {{ __('Create Subcategory') }}
    </x-slot>
    <div class="rounded-lg bg-white p-4 shadow-md">
        <form action="{{ route('subcategories.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Subcategory Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="mt-4">
                <label for="parent_id">Main Category</label>
                <select name="parent_id" id="parent_id" required>
                    <option value="">Select Main Category</option>
                    @foreach($mainCategories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label>
                    <input type="checkbox" name="is_visible" value="1" checked>
                    Visible?
                </label>
            </div>
            <div class="mt-4">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>