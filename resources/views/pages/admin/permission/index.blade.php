@extends('layouts.admin', ['title' => 'Dashboard Permission'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-body">
                @can('permissions.index')
                    {{-- tambah permission --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="javascript:;void(0)" onclick="showModal()" class="btn btn-primary"><i
                                    class="fas fa-plus me-2"></i> Permission</a>
                        </div>
                    </div>
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-permission" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" style="width: 5%">NO.</th>
                                <th scope="col">NAMA PERMISSION</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="permissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="mb-4">

                        <h4 id="label">Tambah Permission </h4>
                    </div>
                    <form id="form-permission" class="row" onsubmit="return false">
                        @csrf


                        <div class="col-12 mb-3">
                            <label class="col-sm-6 col-form-label" for="plEmail">Name Permission</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukan Name Permission"
                                id="permission" required>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                        </div>


                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="button" id="btn-save" class="btn btn-success me-2">Simpan</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $('#table-permission').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.permission.index') }}",
                columns: [{
                        "data": "id",
                        "name": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                ],
                columnDefs: [{
                        "targets": 0, // your case first column
                        "className": "text-center",
                    },
                    {
                        "targets": 1, // your case first column
                        "className": "text-center",
                    },



                ]
            });
        });

        function showModal() {
            $('#permissionModal').modal('show');
        }

        //action create post
        $('#btn-save').click(function(e) {
            e.preventDefault();

            //define variable
            let name = $('#permission').val();

            let token = $("meta[name='csrf-token']").attr("content");

            //ajax
            $.ajax({

                url: `/dashboard/permission`,
                type: "POST",
                cache: false,
                data: {

                    "name": name,
                    "_token": token,

                },
                success: function(response) {
                    $('#permissionModal').modal('hide');

                    //show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        showCancelButton: false,

                        timer: 3000
                    }).then(function() {
                        // form reset
                        $('#form-permission').trigger("reset");
                        //close modal
                        //reload table
                        $('#table-permission').DataTable().ajax.reload();
                    });






                },
                error: function(error) {
                    console.log(error.responseJSON);
                    if (error.responseJSON.name[0]) {

                        //show alert
                        $('#alert-name').removeClass('d-none');
                        $('#alert-name').addClass('d-block');

                        //add message to alert
                        $('#alert-name').html(error.responseJSON.name[0]);
                    }



                }

            });

        });
    </script>
@endpush
