@extends('layout.layout')
@section('title','Manajemen User')
@section('content')
<div class="container" style="margin-left: -200px; margin-top:100px; width: 100vw;">
    <div class="row justify-content-center ">
        <div class="col-md">
            <a class="btn btn-primary me-1" href="{{url('/dashboard')}}">
                Kembali</a>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#tambahmasuk-modal">Tambah</button>

            {{-- modaltambah --}}
            <div class="modal fade" id="tambahmasuk-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambahmasuk-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input placeholder="Username" type="text" class="form-control mb-3" name="username"
                                           id="Username" required/>
                                    <label>Password</label>
                                    <input placeholder="Password" type="password" name="password" class="form-control mb-3"
                                          id="Password" required autocomplete="off">
                                    <label>Role</label>
                                    <select name="role" id="Role" class="form-select mb-3" required>
                                        <option selected value="jamaah">jamaah</option>
                                        <option value="dkm">dkm</option>
                                        <option value="superadmin">superadmin</option>
                                    </select>
                                    @csrf
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="clearText()"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" form="tambahmasuk-form">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>

    <div class="row justify-content-center ">
        <div class="col-md">
            <div class="card mt-2">
                <div class="card-body">
                    <table class="table table-bordered table-hovered DataTable" style="width: 72vw">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                            $no = 1;
                        ?>
                           @foreach($user as $usr)
<tr id="{{$usr->username}}">
    <td class="col-1">{{$no++}}</td>
    @empty($usr->username)
        <td>Pemasukan kosong</td>
    @endempty
    <td class="col-2">{{$usr->username}}</td>
    <td class="col-4">{{$usr->password}}</td>
    <td class="col-1">{{$usr->role}}</td>
    <td col-2>
        <button type="button" class="editBtn btn btn-warning" data-bs-toggle="modal"
            data-bs-target="#edit-modal-{{$usr->username}}" data-id="{{$usr->username}}">
            Edit
        </button>
        <button class="hapusBtn btn btn-danger">Hapus</button>
    </td>
</tr>

                            <div class="modal fade" id="edit-modal-{{$usr->username}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form id="edit-user-form-{{$usr->username}}" enctype="multipart/form-data">
                                            <input type="hidden" name="username" value="{{$usr->username}}">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input placeholder="Username" type="text" class="form-control mb-3" id="Username"
                                                           name="username"
                                                           value="{{$usr->username}}"
                                                           required/>
                                                    <label >Password</label>
                                                    <input placeholder="Password" type="password" class="form-control mb-3" id="Password"
                                                           name="password"
                                                           value="{{$usr->password}}"
                                                           required autocomplete="off"/>
                                                    <label>Role</label>
                                                    <select name="role" class="form-select mb-3" required>
                                                        <option @if($usr->role == 'jamaah') selected
                                                                @endif value="jamaah">jamaah
                                                        </option>
                                                        <option @if($usr->role == 'dkm') selected @endif value="dkm">
                                                            dkm
                                                        </option>
                                                        <option @if($usr->role == 'superadmin') selected @endif value="superadmin">
                                                            superadmin
                                                        </option>
                                                    </select>
                                                    @csrf
                                               </div>
                                           </form>
                                       </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary" onclick="clearText()"
                                                   data-bs-dismiss="modal">
                                               Cancel
                                           </button>
                                           <button type="submit" class="btn btn-primary edit-btn"
                                                   form=
                                                   "edit-user-form-{{$usr->username}}">
                                               Edit
                                           </button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('footer')
    <script type="module">
        $('.table').DataTable();
    $('#tambahmasuk-form').on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(e.target);
            console.log(Object.fromEntries(data))
            axios.post('/user/tambah', data, {
                'Content-Type': 'multipart/form-data'
            })
                .then(() => {
                    $('#tambahmasuk-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                        location.reload();
                    })
                })
                .catch(({response}) => {
                    swal.fire('Gagal tambah data!', `<strong class="text-danger">${response.data.message}</strong>`,
                        'warning');
                });
        })

        //hapus
        //hapus
$('.table').on('click', '.hapusBtn', function () {
    let idUser = $(this).closest('tr').attr('id');
    swal.fire({
        title: "Apakah anda ingin menghapus data ini?",
        showCancelButton: true,
        confirmButtonText: 'Setuju',
        cancelButtonText: `Batal`,
        confirmButtonColor: 'red'
    }).then((result) => {
        if (result.isConfirmed) {
            //dilakukan proses hapus
            axios.delete(`/user/${idUser}/hapus`)
                .then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        swal.fire('Berhasil di hapus!', '', 'success').then(function () {
                            //Refresh Halaman
                            location.reload();
                        });
                    } else {
                        swal.fire('Gagal di hapus!', '', 'warning');
                    }
                })
                .catch(function (error) {
                    console.log(error); // Tambahkan ini untuk menampilkan pesan kesalahan pada konsol
                    swal.fire('Data gagal di hapus!', '', 'error').then(function () {
                        //Refresh Halaman
                        location.reload();
                    });
                });
        }
    });
})



// Pastikan kode dijalankan setelah dokumen siap
$(document).ready(() => {
    $('.editBtn').on('click', function (e) {
        e.preventDefault();
        let username = $(this).data('id');
        let form = $(`#edit-user-form-${username}`);

        // Form submit
        form.on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(this);

            // Tambahkan username ke data FormData
            data.append('username', username);

            axios.post(`/user/${username}/edit`, data)
                .then((response) => {
                    if (response.data.success) {
                        $(`#edit-modal-${username}`).modal('hide');
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        });
                    } else {
                        swal.fire('Gagal edit data!', 'Tidak dapat mengedit data pengguna.', 'warning');
                    }
                })
                .catch(({ response }) => {
                    let message = '';

                    if (response.data.errors) {
                        Object.values(response.data.errors).flat().map((e) =>
                            message += `<strong class="text-danger d-block">${e}</strong>`
                        );
                    }

                    swal.fire('Gagal edit data!', `${message}`, 'warning');
                });
        });
    });
});


    


</script>
    @endsection
