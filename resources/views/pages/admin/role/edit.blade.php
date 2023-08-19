@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">


            <div class="card">
                <div class="card-header">
                    <h5> Edit Role</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.role.update', $role->id) }}" method="POST" id="form-role" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      
                        <div class="row mb-3">
                 
                            <div class="col-md-6">
                                <label class="col-form-label" for="collapsible-role">Nama Role</label>
                                <input type="text" name="name" value="{{ old('name', $role->name) }}" readonly placeholder="Masukkan Nama Role"
                                class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
        
                            </div>
                          </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2">PERMISSIONS</label> <br>
                            
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                    <div class="col-md-3 mb-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="check-{{ $permission->id }}" @if($role->permissions->contains($permission)) checked @endif>
                                            <label class="form-check-label" for="check-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div> 
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary me-2 btn-submit" type="submit"><i class="fa fa-paper-plane me-2"></i>
                            UPDATE</button>
                            <a href="{{ route('admin.role.index') }}" class="btn btn-warning "><i class="fa fa-arrow-left me-2"></i> Kembali</a>

                    </form>
                </div>
            </div>
       
</div>
@endsection

@push('after-script')

<script>
    $("#form-role").submit(function(e){
      $('#body-app').waitMe({
                          effect : 'roundBounce',
                          text : 'Please wait',
                          bg : 'rgba(255,255,255,0.7)',
                          color : '#000',
                          maxSize : '',
                          waitTime : -1,
                          textPos : 'vertical',
                          fontSize : '',
                          source : '',
                          // onClose : function() {}
                      });
  })
</script>
@endpush
