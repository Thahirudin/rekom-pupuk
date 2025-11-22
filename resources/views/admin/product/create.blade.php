@extends('admin.layout.master')
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
        <form class="mx-auto" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-5">
                <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
                <input type="text" id="name" name="name"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="Input Your Name" required />
            </div>
            <div class="mb-5">
                <label for="nutrients" class="block mb-2.5 text-sm font-medium text-heading">Nutrients</label>
                <input type="text" id="nutrients" name="nutrients"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="Input Your nutrients" required />
            </div>
            <div class="mb-5">
                <label for="landType" class="block mb-2.5 text-sm font-medium text-heading">Land Type</label>
                <input type="text" id="landType" name="landType"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="Input Your landType" required />
            </div>
            <div class="mb-5">
                <label for="age" class="block mb-2.5 text-sm font-medium text-heading">Age</label>
                <select id="age" name="age"
                    class="block py-2.5 ps-0 w-full text-sm text-body bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer">
                    <option value="<5 Tahun">
                        <5 Tahun</option>
                    <option value="5-10 Tahun">5-10 Tahun</option>
                    <option value="10-15 Tahun">10-15 Tahun</option>
                    <option value="15-20 Tahun">15-20 Tahun</option>
                    <option value="15-20 Tahun">Semua Umur</option>
                </select>
            </div>
            <div class="mb-5">
                <label for="condition" class="block mb-2.5 text-sm font-medium text-heading">Condition</label>
                <input type="text" id="condition" name="condition"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="Input Your condition" required />
            </div>
            <div class="mb-5">
                <label for="price" class="block mb-2.5 text-sm font-medium text-heading">price</label>
                <input type="number" id="price" name="price"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="Input Your price" required />
            </div>
            <div class="mb-5">
                <label for="benefit" class="block mb-2.5 text-sm font-medium text-heading">benefit</label>
                <input type="text" id="benefit" name="benefit"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="Input Your benefit" required />
            </div>
            <div class="mb-5">
                <label for="image" class="block mb-2.5 text-sm font-medium text-heading">image</label>
                <input type="file" id=imaget" name="image"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="Input Your image" required />
            </div>
            <button type="submit"
                class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Submit</button>
        </form>
    </div>
@endsection
@section('addJs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
