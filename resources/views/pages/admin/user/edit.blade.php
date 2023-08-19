@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="card">
            <div class="card-header">
                <h4> Edit User</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.user.update', $user->id) }}" id="form-user" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">NAMA</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            placeholder="Masukkan Nama" class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">EMAIL</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="Masukkan Email" class="form-control @error('email') is-invalid @enderror">

                        @error('email')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">PASSWORD</label>
                                <input type="password" name="password" value="{{ old('password') }}"
                                    placeholder="Masukkan Password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">PASSWORD</label>
                                <input type="password" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" placeholder="Masukkan Konfirmasi Password"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">ROLE</label> <br>

                        <select name="role" id=""
                            class="form-control select @error('role') is-invalid @enderror">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>

                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="btn btn-primary me-2 btn-submit" type="submit"><i class="fa fa-paper-plane me-2"></i>
                        UPDATE</button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-warning "><i
                            class="fa fa-arrow-left me-2"></i> Kembali</a>

                </form>
            </div>
        </div>

    </div>
@endsection

@push('after-script')
    <script>
        $("#form-user").submit(function(e) {
            $('#body-app').waitMe({
                effect: 'roundBounce',
                text: 'Please wait',
                bg: 'rgba(255,255,255,0.7)',
                color: '#000',
                maxSize: '',
                waitTime: -1,
                textPos: 'vertical',
                fontSize: '',
                source: '',
                // onClose : function() {}
            });
        })
    </script>
@endpush
