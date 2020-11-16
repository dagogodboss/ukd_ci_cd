@extends('layouts.admin-app')

@section('content')
<div class="layout-px-spacing">
<div class="container">
    <div class="container">
        <div class="row layout-top-spacing mb4">
            <div class="col-lg-12 col-12 layout-spacing">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-link active" href="{{ route('employee.index') }}">Employees</a>
                    </div>
                </div>
            </div>
        </div>

<div class="row">
    <div id="tabsAlignments" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="justify-tab">Employee Data Entry</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area justify-tab">

                <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="justify-home-tab" data-toggle="tab" href="#justify-home" role="tab" aria-controls="justify-home" aria-selected="true">Employee Bio-Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-profile-tab" data-toggle="tab" href="#justify-profile" role="tab" aria-controls="justify-profile" aria-selected="false">Contact Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-contact-tab" data-toggle="tab" href="#justify-contact" role="tab" aria-controls="justify-contact" aria-selected="false">Salary Details</a>
                    </li>
                </ul>

                <form class="form" action="{{ route('employee.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="auditor_id" value="{{user()->id}}"/>
                <div class="tab-content" id="justifyTabContent">
                    <div class="tab-pane fade show active" id="justify-home" role="tabpanel" aria-labelledby="justify-home-tab">
                        <div class="widget-content widget-content-area mb-4">
                            <div class="row mb-4">
                                @foreach ($formFields as $key => $formField)
                                    <div class="col-md-6">
                                        <label class="label">
                                            {{ $formField->label }}
                                        </label>
                                        @if($formField->type == 'select')
                                        <select name="{{ $formField->name }}" class="form-control  basic">
                                            <option value="">Select {{ $formField->label}}</option>
                                            @foreach($formField->options as $field => $value)
                                            <option value="{{$value}}">
                                                {{$value}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @else
                                        <input
                                            type="{{ $formField->type }}" class="form-control  mb-2 mr-sm-2"
                                            name="{{ $formField->name }}"
                                            placeholder=""
                                            required
                                            @if($formField->name == 'employee_code')
                                            value={{ $employee_code }} @endif
                                        />
                                        @endif
                                    </div>
                                @endforeach
                                    <div class="col-md-6">
                                        <label class="label">
                                            Department
                                        </label>
                                        <select name="department_id" class="form-control  basic">
                                            <option>Select Department</option>
                                            @forelse($departments as $key => $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->title }}
                                                </option>
                                            @empty
                                            <option>
                                                No Department
                                            </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label">
                                            Designation
                                        </label>
                                        <select name="designation_id" class="form-control  basic">
                                            <option>Select Designation</option>
                                            @forelse($designations as $key => $designation)
                                                <option value="{{ $designation->id }}">
                                                    {{ $designation->title }}
                                                </option>
                                            @empty
                                            <option>
                                                No Designations
                                            </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label">
                                            Role (Permissions)
                                        </label>
                                        <select name="role_id" class="form-control  basic">
                                            <option>Select Role</option>
                                            @forelse($roles as $key => $role)
                                                <option value="{{ $role->id }}">
                                                    {{ $role->name }}
                                                </option>
                                            @empty
                                            <option>
                                                No Role
                                            </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label">
                                            Branch
                                        </label>
                                        <select name="branch_id" class="form-control  basic">
                                            <option>Select Designation</option>
                                            @forelse($branches as $key => $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->title }}
                                                </option>
                                            @empty
                                            <option>
                                                No Branch
                                            </option>
                                            @endforelse
                                        </select>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-profile" role="tabpanel" aria-labelledby="justify-profile-tab">
                        <div class="media">
                            <div class="media-body">
                                <div class="widget-content widget-content-area mb-4">
                                    <div class="row mb-4">
                                        @foreach ($contactFormFields as $key => $formField)
                                            <div class="col-md-6">
                                                <label class="label">
                                                    {{ $formField->label }}
                                                </label>
                                                @if($formField->type == 'textarea')
                                                <textarea class="form-control" name="{{$formField->name}}" placeholder="{{ $formField->label }}"></textarea>
                                                @else
                                                <input
                                                    type="{{ $formField->type }}" class="form-control  mb-2 mr-sm-2"
                                                    name="{{ $formField->name }}"
                                                    placeholder=""
                                                    required
                                                    @if($formField->name == 'employee_code')
                                                    value={{ $employee_code }} @endif
                                                />
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-contact" role="tabpanel" aria-labelledby="justify-contact-tab">
                        <div class="widget-content widget-content-area mb-4">
                            <div class="row mb-4">
                                @foreach ($salaryFormFields as $key => $formField)
                                    <div class="col-md-6">
                                        <label class="label">
                                            {{ $formField->label }}
                                        </label>
                                        @if($formField->type == 'textarea')
                                            <textarea class="form-control" name="{{$formField->name}}" placeholder="{{ $formField->label }}"></textarea>
                                            @else
                                            <input
                                                type="{{ $formField->type }}" class="form-control  mb-2 mr-sm-2 {{ $formField->name }} @if($formField->name == 'gross')salary @endif"
                                                name="{{ $formField->name }}"
                                                placeholder="{{ $formField->label  }}"
                                                @if($formField->readonly) readonly @endif
                                            />
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
</div>
@endsection

@section('script')
    <script>
        var ss = $(".basic").select2({
            tags: true,
        });
        $('.salary').on('input', function(e){
            salary = $(this).val()
            let salaryType = [
                basic_salary ={'name' : 'basic_salary', 'percent' :30},
                accommodation_allowance ={'name' :'accommodation_allowance', 'percent' :25},
                house_rent_allowance = {'name' : 'house_rent_allowance', 'percent' :10},
                transportation_allowance={'name' : 'transportation_allowance','percent' :1
            }];
            salaryType.map((index, name)=>{
                $(`.${index.name}`).attr('value', (salary * (index.percent/100)).toFixed(2))
            });
        });
    </script>
@endsection
