@extends('admin.layout.master')
@section('addCss')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />
@endsection
@section('content')
    <div class="p-5 border border-gray-200 rounded-md">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded-md bg-red-100 text-red-700">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex gap-5 w-full justify-between items-center">
            <h2 class=" text-xl ">Data User</h2>
            <a href="{{ route('user.create') }}"
                class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Tambah
                Data</a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-body" id="myTable">
                <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Search Name"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </td>
                        <td><input type="text" placeholder="Search Name"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </td>
                        <td><input type="text" placeholder="Search Name"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </td>
                        <td><input type="text" placeholder="Search Name"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <td class="px-6 py-4">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->username }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->role }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                    class="font-medium text-fg-brand hover:underline">Edit</a>
                                <button onclick="deleteUser({{ $user->id }})"
                                    class="font-medium text-red-500 hover:underline cursor-pointer">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form id="deleteForm" method="POST" class="visible">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
@section('addJs')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {

            let table = $('#myTable').DataTable({
                orderCellsTop: true,
                fixedHeader: true
            });

            // Per-column search
            $('#myTable thead tr:eq(1) td').each(function(i) {
                $('input', this).on('keyup change', function() {
                    table.column(i).search(this.value).draw();
                });
            });
            $('#dt-search-0').removeClass('dt-input');
            $('#dt-search-0').addClass(
                'bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body'
            );
            $('#dt-length-0').removeClass('dt-input');

            $('#dt-length-0').addClass(
                'bg-neutral-secondary-medium gap-4 border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-5 py-2.5 shadow-xs placeholder:text-body'
            );

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteUser(id) { // ✅ GLOBAL, tombol onclick bisa akses
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('deleteForm');
                    form.action = "/user/delete/" + id;
                    form.submit();
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
