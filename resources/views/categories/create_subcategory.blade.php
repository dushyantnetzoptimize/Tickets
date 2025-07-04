<x-app-layout>
    <x-slot name="header">
        {{ __('Add Subcategory') }}
    </x-slot>

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form method="POST" action="{{ route('categories.storeSubcategory') }}">
            @csrf
            <div>
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label>Visible?</label>
                <input type="checkbox" name="is_visible" value="1">
            </div>
            <div>
                <label>Parent Category</label>
                <select name="parent_id" required>
                    @foreach($mainCategories as $mainCategory)
                        <option value="{{ $mainCategory->id }}">{{ $mainCategory->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Add Subcategory</button>
        </form> 

    </div>
</x-app-layout>



<?php
