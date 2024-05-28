@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Edit Permission</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">User Management</li>
                        <li class="breadcrumb-item active"> Edit Permission</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        {{-- <h4>Tooltip form validation</h4>
                        <p class="f-m-light mt-1">
                            If your form layout allows it, you can swap the <code>.{valid|invalid}</code>-feedback classes for<code>.{valid|invalid}</code>-tooltip classes to display validation feedback in a styled tooltip. Be sure to have a parent with <code>position: relative</code> on it for tooltip positioning.
                        </p> --}}
                    </div>
                    <div class=" m-4 d-flex justify-content-between">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">



                        <form name="createForm" method="post" action="{{route('roles.permission.store',$role_name)}}" class="row g-3 needs-validation custom-input">
									@csrf
                           <div class="form-group">
										<div class="row">
											<div class="col-md-3"><label class="form-label">Select Permissions</label></div>
											<div class="col-md-9">


                                                @foreach($totalRecord as $permission)
    <div class="topic">
        <input type="checkbox" class="parent-permission" name="permission[]" id="{{$permission->id}}" value="{{$permission->name}}"
        @if($checked !=null)
            @if(!empty($checked->permission))
                {{ (in_array($permission->name, $checked->permission )) ? 'checked' : '' }}
            @endif
        @endif
        />
        <label for="{{$permission->id}}">{{$permission->name}}</label><br>
    </div>
    @if(!empty($permission->sub_permission))
        <div class="subtopic" data-parentid="{{$permission->id}}">
            <ul class="inputs-list">
                <li style="list-style-type: none">
                    @foreach(json_decode($permission->sub_permission) as $detail)
                        &nbsp; &nbsp;  &nbsp;  &nbsp;
                        <input type="checkbox" class="child-permission" data-parentid="{{$permission->id}}" name="sub_permission[]" id="sub_permission_{{$detail}}" value="{{$detail}}"
                        @if($checked !=null)
                            @if(!empty($checked->sub_permissions))
                                {{ (in_array($detail, json_decode($checked->sub_permissions) )) ? 'checked' : '' }}
                            @endif
                        @endif
                        />
                        <label for="sub_permission_{{$detail}}">{{$detail}}</label><br>
                    @endforeach
                </li>
            </ul>
        </div>
    @endif
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all parent checkboxes
        const parentCheckboxes = document.querySelectorAll('.parent-permission');

        parentCheckboxes.forEach(parentCheckbox => {
            const parentId = parentCheckbox.id;
            const childCheckboxes = document.querySelectorAll(`.child-permission[data-parentid="${parentId}"]`);

            // Function to check if any child checkboxes are checked
            const checkChildren = () => {
                const anyChecked = Array.from(childCheckboxes).some(child => child.checked);
                parentCheckbox.checked = anyChecked;
            };

            // Function to select/deselect all child checkboxes
            const toggleChildren = (isChecked) => {
                childCheckboxes.forEach(child => {
                    child.checked = isChecked;
                });
            };

            // Initial check on page load
            checkChildren();

            // Add event listener to parent checkbox
            parentCheckbox.addEventListener('change', function() {
                toggleChildren(this.checked);
            });

            // Add event listener to each child checkbox
            childCheckboxes.forEach(childCheckbox => {
                childCheckbox.addEventListener('change', checkChildren);
            });
        });
    });
    </script>






												@error('permission')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</div>
										</div>
									</div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
