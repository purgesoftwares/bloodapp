@extends('auth/template')

@section('content')
                <h2 class="text-center">Profile</h2>
                <form role="form" method="POST" action="{{ url('auth/profile') }}">
                    <input type="hidden" name="_token" value="{{ session()->getToken() }}">
					<input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row">

                        <div class="form-group col-lg-6 {{ $errors->has('name')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Name" name="name" type="text" value="{{ (null !== old('name')) ? old('name') : $user->name }}" required>
                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                        <div class="form-group col-lg-6 {{ $errors->has('email')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="E-Mail Address" disabled=disabled name="email" type="email" value="{{ $user->email }}" required>
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                    </div>
                    <div class="row">

                        <div class="form-group col-lg-6 {{ $errors->has('blood_group')? 'has-error' : '' }}">
							<select class="form-control" name="blood_group" type="text" required>
								<option value="">Select Blood Group</option>
								<option value="O-" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='O-')? "selected=selected" : "" }}>O-</option>
								<option value="0+" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='O+')? "selected=selected" : "" }} >0+</option>
								<option value="A-" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='A-')? "selected=selected" : "" }} >A-</option>
								<option value="A+" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='A+')? "selected=selected" : "" }} >A+</option>
								<option value="B-" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='B-')? "selected=selected" : "" }} >B-</option>
								<option value="B+" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='B+')? "selected=selected" : "" }}>B+</option>
								<option value="AB-" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='AB-')? "selected=selected" : "" }}>AB-</option>
								<option value="AB+" {{ (((null !== old('blood_group')) ? old('blood_group') : $user->blood_group)=='AB+')? "selected=selected" : "" }}>AB+</option>
							</select>
                            {!! $errors->first('blood_group', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                        <div class="form-group col-lg-6 {{ $errors->has('city_id')? 'has-error' : '' }}">
                            <select class="form-control" name="city_id" type="text" required>
								<option value="">Select Your City</option>
								@foreach ($cities as $city)
									<option value="{{$city->id}}" {{ (((null !== old('city_id')) ? old('city_id') : $user->city_id)==$city->id)? "selected=selected" : "" }}>{{$city->name}}</option>
								@endforeach
							</select>
                            {!! $errors->first('city_id', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                    </div>
                    
					<div class="row">

                        <div class="form-group col-lg-6 {{ $errors->has('height')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Height (In Feets)" name="height" type="number" value="{{ (null !== old('height')) ? old('height') : $user->height }}" required>
                            {!! $errors->first('height', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                        <div class="form-group col-lg-6 {{ $errors->has('weight')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Weight (In Kilograms)" name="weight" type="number" value="{{ (null !== old('weight')) ? old('weight') : $user->weight }}" required>
                            {!! $errors->first('weight', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                    </div>
					<div class="row">

                        <div class="form-group col-lg-6 {{ $errors->has('age')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Age (In Years)" name="age" type="number" value="{{ (null !== old('age')) ? old('age') : $user->age }}" required>
                            {!! $errors->first('age', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group col-lg-6 {{ $errors->has('mobile')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Mobile Number" name="mobile" type="number" value="{{ (null !== old('mobile')) ? old('mobile') : $user->mobile }}" required>
                            {!! $errors->first('mobile', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                    </div>
					
					<div class="row">

                        <div class="form-group col-lg-6 {{ $errors->has('last_donation_date')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Last Donation Date" name="last_donation_date" type="date" value="{{ (null !== old('last_donation_date'))? old('last_donation_date') : $user->last_donation_date }}" required>
                            {!! $errors->first('last_donation_date', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                        <div class="form-group col-lg-6 {{ $errors->has('last_ill_date')? 'has-error' : '' }}">
                            <input class="form-control" placeholder="Last Donation Date" name="last_ill_date" type="date" value="{{ (null !== old('last_ill_date'))? old('last_ill_date') : $user->last_ill_date }}" required>
                            {!! $errors->first('last_ill_date', '<small class="help-block">:message</small>') !!}
                        </div>
                        
                    </div>
						
                    <div class="row">
                        
                        <div class="form-group col-lg-12 text-center">
                            <input class="btn btn-default" type="submit" value="Save">
                        </div> 
                        
                    </div>
                </form>                        
@stop
