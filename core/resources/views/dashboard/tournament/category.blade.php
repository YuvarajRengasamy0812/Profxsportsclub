@extends('dashboard.layouts.master')
@section('title', 'Tournament List')
@section('content')
<div class="padding">
    <div class="box">

        {{-- Header --}}
        <div class="box-header dker">
            <h2><i class="material-icons">&#xe7fe;</i> Category List</h2>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
            </small>
        </div>

        <div class="row p-a">

            {{-- Category Table --}}
            <div class="col-md-8 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                            <tr>
                                <th class="width20 dker">
                                    <label class="ui-check m-a-0">
                                        <input id="checkAll" type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Name</th>
                                <th>Parent Category</th>
                                <th class="text-center" style="width:50px;">Status</th>
                                <th class="text-center" style="width:200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $cat)
                            <tr>
                                <td class="dker">
                                    <label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $cat->id }}"><i class="dark-white"></i>
                                    </label>
                                </td>
                                <td class="h6">{{ $cat->catname }}</td>
                                <td class="h6">{{ $cat->parent?->catname ?? '-' }}</td>
                                <td class="text-center">{{ $cat->status ? 'Active' : 'Inactive' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-success"
                                        onclick="editCategory({{ $cat->id }}, '{{ $cat->catname }}', '{{ $cat->parent_id }}', '{{ $cat->registerstartDate }}', '{{ $cat->eventstartDate }}', '{{ $cat->description }}', '{{ $cat->status }}')">
                                        <i class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center font-bold">
                                    No categories found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $categories->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            {{-- Add / Edit Form --}}
            <div class="col-md-4 col-sm-12">
                <div class="box-header dker mb-3">
                    <h2><i class="material-icons">&#xe7fe;</i> Add / Edit Category</h2>
                </div>

                <form method="POST" action="{{ route('categoriesstore') }}" id="category-form">
                    @csrf
                    <input type="hidden" name="id" id="form-id">

                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="catname" id="form-catname" required >
                        <span id="catname-error" class="text-danger" style="display:none;"></span>
                    </div>

                    <div class="form-group">
                        <label>Parent Category</label>
                        <select name="parent_id" id="form-parent" class="form-control">
                            <option value="0">None</option>
                            @foreach($parentcat as $c)
                                <option value="{{ $c->id }}">{{ $c->catname }}</option>
                            @endforeach
                        </select>
                    </div>
					
					<div class="form-group">
                        <label>Register Start Date</label>
                        <input type="date" class="form-control" name="registerstartDate" id="form-registerstartDate" />
                        <span id="registerstartDate-error" class="text-danger" style="display:none;"></span>
                    </div>
					
					<div class="form-group">
                        <label>Event Start Date</label>
                        <input type="date" class="form-control" name="eventstartDate" id="form-eventstartDate" />
                        <span id="eventstartDate-error" class="text-danger" style="display:none;"></span>
                    </div>
					
					<div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="form-status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" id="form-submit">Add Category</button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
function editCategory(id, name, parent_id, registerstartDate, eventstartDate, description,  status) {
    document.getElementById('form-id').value = id;
    document.getElementById('form-catname').value = name; // keeps current name
    document.getElementById('form-status').value = status;

    parent_id = parent_id ?? 0;
    document.getElementById('form-parent').value = parent_id;
    document.getElementById('form-registerstartDate').value = registerstartDate;
    document.getElementById('form-eventstartDate').value = eventstartDate;
    document.getElementById('description').value = description;

    document.getElementById('form-submit').innerText = "Update Category";
    $('#catname-error').hide(); // hide previous errors
}

function resetForm() {
    document.getElementById('form-id').value = "";
    document.getElementById('form-catname').value = "";
    document.getElementById('form-parent').value = "0";
    document.getElementById('form-status').value = "1";
    document.getElementById('form-submit').innerText = "Add Category";
    $('#catname-error').hide();
}

// Select all checkboxes
document.getElementById('checkAll').addEventListener('click', function() {
    document.querySelectorAll('input[name="ids[]"]').forEach(cb => cb.checked = this.checked);
});

// jQuery validation for duplicate category name
$(document).ready(function() {
    $('#category-form').on('submit', function(e) {
        e.preventDefault();
        let catname = $('#form-catname').val();
        let id = $('#form-id').val();

        $.ajax({
            url: '{{ route("catnameexit") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                catname: catname,
                id: id
            },
            success: function(response) {
                if(response.exists) {
                    $('#catname-error').text('Category name already exists!').show();
                } else {
                    $('#catname-error').hide();
                    $('#category-form')[0].submit();
                }
            }
        });
    });
});
</script>
@endpush
