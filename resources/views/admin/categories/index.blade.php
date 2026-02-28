@extends('layouts.admin')

@section('header_title', 'Categories Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 text-heading fw-bold">Job Categories</h4>
            <p class="text-muted mb-0">Organize jobs into categories.</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus-lg me-1"></i> Add Category
        </button>
    </div>

    <!-- Search Bar -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="d-flex gap-2">
                <div class="flex-grow-1">
                    <input type="text" name="search" class="form-control" placeholder="Search categories..."
                        value="{{ $search ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i>Search
                </button>
                @if($search)
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                placeholder="e.g. Information Technology">
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label fw-medium">Icon (Emoji)</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="🏗️" maxlength="2">
                            <small class="text-muted">Choose an emoji to represent this category</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Save Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-nowrap mb-0">
                    <thead class="table-light">
                        <tr class="text-muted text-uppercase" style="font-size: 0.75rem;">
                            <th scope="col" class="ps-4" style="width: 60px;">Icon</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Jobs Count</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center justify-content-center bg-light rounded-circle"
                                        style="width: 40px; height: 40px; font-size: 1.5rem;">
                                        {{ $category->icon }}
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $category->name }}</h6>
                                </td>
                                <td class="text-muted">{{ $category->slug }}</td>
                                <td>
                                    <span
                                        class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
                                        {{ $category->jobs_count ?? 0 }} Jobs
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal{{ $category->id }}">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body px-4">
                                                <div class="mb-3">
                                                    <label for="name{{ $category->id }}" class="form-label fw-medium">Category
                                                        Name</label>
                                                    <input type="text" class="form-control" id="name{{ $category->id }}"
                                                        name="name" value="{{ $category->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="icon{{ $category->id }}" class="form-label fw-medium">Icon
                                                        (Emoji)</label>
                                                    <input type="text" class="form-control" id="icon{{ $category->id }}"
                                                        name="icon" value="{{ $category->icon }}" maxlength="2">
                                                    <small class="text-muted">Choose an emoji to represent this category</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check-lg me-1"></i>Update Category
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-3">
                                        <div class="avatar-lg bg-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px;">
                                            <i class="bi bi-tags fs-2"></i>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold">No categories found</h5>
                                    <p class="text-muted">Create your first category to get started.</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal">
                                        <i class="bi bi-plus-lg me-1"></i> Add Category
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection