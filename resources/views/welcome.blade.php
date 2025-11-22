<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Pupuk Kelapa Sawit</title>
    <style>
        * {
            box-sizing: border-box;
        }

        /* Styles remain unchanged */
        :root {
            --primary-color: #28a745;
            --primary-hover: #218838;
            --border-color: #ccc;
            --bg-light: #f8f8f8;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--bg-light);
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            max-width: 1200px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow);
        }

        .left-menu,
        .right-menu {
            flex: 1;
            min-width: 300px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2c3e50;
        }

        select,
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        select:focus,
        input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        button {
            width: 100%;
            padding: 12px 20px;
            background-color: var(--primary-color);
            border: none;
            color: white;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        .results {
            margin-top: 25px;
            padding: 20px;
            border-radius: 8px;
            background: #f8f9fa;
            border: 1px solid var(--border-color);
        }

        .product-card {
            display: flex;
            gap: 20px;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 6px var(--shadow);
        }

        .product-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            flex: 1;
        }

        .product-info h4 {
            margin: 0 0 10px 0;
            color: #2c3e50;
        }

        .product-info p {
            margin: 5px 0;
            color: #566573;
        }

        .contact {
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
            background: #e8f5e9;
            border: 1px solid #a5d6a7;
        }

        .contact h4 {
            margin: 0 0 15px 0;
            color: #2c3e50;
        }

        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            position: relative;
            max-height: 80vh;
            overflow-y: auto;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #e74c3c;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #c0392b;
        }

        .documentation {
            margin-top: 30px;
        }

        .documentation h2 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .documentation {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .documentation img {
            width: calc(50% - 10px);
            height: auto;
            border-radius: 8px;
        }

        @media (max-width: 400px) {
            .container {
                padding: 10px !important;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-menu,
            .right-menu {
                width: 100%;
            }

            .documentation img {
                width: 100%;
            }
        }

        .admin-mode {
            display: none;
            /* Initially hide admin section */
        }

        .popup {
            display: none;
            /* Admin login popup */
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .product-input {
            display: none;
            /* Initially hide product input form */
        }

        .delete-button {
            width: 100%;
            background-color: #e74c3c;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .admin-buttons {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
            /* Adding some spacing below the buttons */
        }

        .admin-buttons button {
            width: auto;
            /* Make button width auto */
            margin-bottom: 5px;
            /* Add spacing between buttons */
        }

        .logo-container {
            display: flex;
            justify-content: space-around;
            /* Distribute logos evenly */
            align-items: center;
            /* Center logos vertically */
            margin-top: 20px;
            /* Add spacing above logos */
        }

        .logo-container img {
            border-radius: 10%;
            /* Make logos circular */
        }

        /* Make logos circular */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="left-menu">
            <div class="admin-buttons">
                <button onclick="showAdminLogin()">Login Admin</button>
                <div class="admin-mode" id="adminMode">
                    <button onclick="showProductInput()">Tambah Produk Pupuk</button>
                    <button class="delete-button" onclick="deleteProduct()">Hapus Produk Pupuk</button>
                    <button class="delete-button" onclick="logoutAdmin()">Logout</button>
                </div>
            </div>

            <h1>Sistem Rekomendasi Pupuk Kelapa Sawit</h1>

            <div class="form-group" id="userOptions">
                <label for="landType">Jenis Lahan:</label>
                <select id="landType">
                    <option value="">Pilih jenis lahan</option>
                    <option value="Lahan pasir">Lahan pasir</option>
                    <option value="Lahan gambut">Lahan gambut</option>
                    <option value="Lahan darat">Lahan darat</option>
                </select>
            </div>

            <div class="form-group">
                <label for="plantAge">Umur Tanaman:</label>
                <select id="plantAge">
                    <option value="">Pilih umur tanaman</option>
                    <option value="<5 tahun">
                        &lt;5 tahun</option>
                    <option value="5-10 tahun">5-10 tahun</option>
                    <option value="10-15 tahun">10-15 tahun</option>
                    <option value="15-20 tahun">15-20 tahun</option>
                </select>
            </div>

            <div class="form-group">
                <label for="lastFertilizer">Pupuk Terakhir:</label>
                <input type="text" id="lastFertilizer" placeholder="Masukkan nama pupuk terakhir">
            </div>

            <div class="form-group">
                <label for="landCond">Kondisi Lahan Sawit:</label>
                <select id="landCond">
                    <option value="">Pilih kondisi lahan</option>
                    <option value="Buah Sehat atau Normal">Buah Sehat atau Normal</option>
                    <option value="Buah Tidak Sehat">Buah Tidak Sehat</option>
                </select>
            </div>

            <button onclick="findFertilizer()">Cari Rekomendasi Pupuk</button>


            <div class="results" id="results"></div>

            <div class="contact">
                <h4>Kontak Konsultasi</h4>
                <p>Untuk informasi takaran dan pemesanan, silakan hubungi:</p>
                <p><strong>Gea Asti Nasabeth</strong></p>
                <p>Telepon: <a href="tel:+6281261578602">+6281261578602</a></p>
            </div>
        </div>

        <div class="right-menu">
            <h1>Referensi Produk PT.KAL</h1>
            <div class="form-group">
                <label for="productType">Jenis Produk:</label>
                <select id="productType">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <button onclick="showProductInfo()">Cari Informasi Produk</button>

            <div class="documentation">
                <h2>Dokumentasi Seluruh Produk Kami</h2>
                <img src="https://drive.google.com/thumbnail?id=1za1MhGzED1XKAkCARhYnlVqD3gN3hwHJ" alt="Gambar Pertama">
                <img src="https://drive.google.com/thumbnail?id=1XqGzXLVtpD1Vcndri8E3qYF1G2SdWtnf" alt="Gambar Kedua">
                <img src="https://drive.google.com/thumbnail?id=1fln5gpsGGXNvu5nEnJL-4_AzhzrahqKv" alt="Gambar Ketiga">
                <img src="https://drive.google.com/thumbnail?id=1nErfvlZoumnghWm8aLXA-XofO1EPGEeZ" alt="Gambar Keempat">
            </div>

        </div>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">×</span>
            <h4 id="popupTitle">Detail Produk</h4>
            <div id="popupDetails"></div>
        </div>
    </div>

    <!-- Popup for admin login -->
    <div class="popup" id="adminLoginPopup">
        <div class="popup-content">
            <span class="close" onclick="closeAdminLogin()">×</span>
            <form action="{{ route('login') }}" method="post">
                @csrf
                @method('POST')
                <h4>Login Admin</h4>
                <div class="form-group">
                    <label for="adminId">ID:</label>
                    <input type="text" id="adminId" name="username" placeholder="Masukkan ID admin">
                </div>
                <div class="form-group">
                    <label for="adminPassword">Password:</label>
                    <input type="password" id="adminPassword" name="password" placeholder="Masukkan password admin">
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <!-- Product input section -->
    <div class="popup" id="productInputPopup">
        <div class="popup-content">
            <span class="close" onclick="closeProductInput()">×</span>
            <h4>Tambah Produk Pupuk</h4>
            <div class="form-group">
                <label for="productId">ID Produk:</label>
                <input type="text" id="productId" placeholder="Masukkan ID produk" />
            </div>
            <div class="form-group">
                <label for="productName">Nama Produk Pupuk:</label>
                <input type="text" id="productName" placeholder="Masukkan nama produk" />
            </div>
            <div class="form-group">
                <label for="chemicalContent">Unsur Kimia:</label>
                <input type="text" id="chemicalContent" placeholder="Masukkan unsur kimia" />
            </div>
            <div class="form-group">
                <label for="landTypeInput">Tipe Lahan:</label>
                <select id="landTypeInput">
                    <option value="Lahan darat">Lahan darat</option>
                    <option value="Lahan gambut">Lahan gambut</option>
                    <option value="Lahan pasir">Lahan pasir</option>
                </select>
            </div>
            <div class="form-group">
                <label for="plantAgeInput">Umur:</label>
                <select id="plantAgeInput">
                    <option value="<5 tahun">
                        <5 tahun</option>
                    <option value="5-10 tahun">5-10 tahun</option>
                    <option value="10-15 tahun">10-15 tahun</option>
                    <option value="15-20 tahun">15-20 tahun</option>
                </select>
            </div>
            <div class="form-group">
                <label for="conditionInput">Kondisi:</label>
                <select id="conditionInput">
                    <option value="Buah Sehat atau Normal">Buah Sehat atau Normal</option>
                    <option value="Buah Tidak Sehat">Buah Tidak Sehat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priceInput">Harga:</label>
                <input type="text" id="priceInput" placeholder="Rp." />
            </div>
            <div class="form-group">
                <label for="benefitInput">Manfaat:</label>
                <input type="text" id="benefitInput" placeholder="Masukkan manfaat" />
            </div>
            <div class="form-group">
                <label for="imageInput">Source Gambar Produk:</label>
                <input type="text" id="imageInput" placeholder="URL gambar" />
            </div>
            <button id="addProductButton" onclick="addProduct()">Input Produk</button>
        </div>
    </div>

    <script>
        const fertilizers = [
            @foreach ($products as $product)
                {
                    "id": {{ $product->id }},
                    "name": "{{ $product->name }}",
                    "nutrients": "{{ $product->nutrients }}",
                    "land_type": "{{ $product->landType }}",
                    "age": "{{ $product->age }}",
                    "condition": "{{ $product->condition }}",
                    "price": {{ $product->price }},
                    "benefit": "{{ $product->benefit }}",
                    "image": "{{ $product->image }}"
                },
            @endforeach
        ];
        fertilizers.forEach(f => {
            f.age = f.age.replace('&lt;', '<').toLowerCase();
            f.condition = f.condition.toLowerCase();
            f.land_type = f.land_type.toLowerCase();
        });
        console.log(fertilizers);
        // Global variables
        let isAdminLoggedIn = false;

        // Show Admin Login Popup
        function showAdminLogin() {
            document.getElementById("adminLoginPopup").style.display = "flex";
        }

        function closeAdminLogin() {
            document.getElementById("adminLoginPopup").style.display = "none";
        }

        function loginAdmin() {
            const id = document.getElementById("adminId").value;
            const password = document.getElementById("adminPassword").value;

            if (id === 'admin' && password === 'admin') {
                isAdminLoggedIn = true;
                document.getElementById("adminMode").style.display = "block"; // Show admin options
                document.getElementById("userOptions").style.display = "none"; // Hide user options
                closeAdminLogin();
                alert("Login berhasil!");
            } else {
                alert("ID atau password salah!");
            }
        }

        // Show Product Input Form as Popup
        function showProductInput() {
            document.getElementById("productInputPopup").style.display = "flex";
        }

        function closeProductInput() {
            document.getElementById("productInputPopup").style.display = "none";
        }

        // Add Product Function
        function addProduct() {
            const newProduct = {
                id: document.getElementById("productId").value,
                name: document.getElementById("productName").value,
                nutrients: document.getElementById("chemicalContent").value,
                land_type: document.getElementById("landTypeInput").value,
                age: document.getElementById("plantAgeInput").value,
                condition: document.getElementById("conditionInput").value,
                price: document.getElementById("priceInput").value,
                benefit: document.getElementById("benefitInput").value,
                image: document.getElementById("imageInput").value
            };

            // Simpan atau tambahkan produk baru ke daftar produk
            fertilizers.push(newProduct); // You may want to handle this in a more appropriate way
            alert("Produk berhasil ditambahkan!");
            closeProductInput(); // Close the product input popup
        }

        // Logout Admin Function
        function logoutAdmin() {
            isAdminLoggedIn = false;
            document.getElementById("adminMode").style.display = "none"; // Hide admin options
            document.getElementById("userOptions").style.display = "block"; // Show user options again
            alert("Anda telah logout.");
        }

        // Delete Product Function
        function deleteProduct() {
            const productId = prompt("Masukkan ID produk yang ingin dihapus:");
            if (!productId) {
                alert("ID produk tidak boleh kosong!");
                return;
            }

            const productIndex = fertilizers.findIndex(product => product.id === productId);
            if (productIndex !== -1) {
                fertilizers.splice(productIndex, 1);
                alert(`Produk dengan ID ${productId} berhasil dihapus!`);
            } else {
                alert(`Produk dengan ID ${productId} tidak ditemukan!`);
            }
        }

        // Show Product Info
        function showProductInfo() {
            const selectedProduct = parseInt(document.getElementById("productType").value);
            console.log(selectedProduct);
            if (!selectedProduct) {
                alert("Silakan pilih produk terlebih dahulu.");
                return;
            }
            console.log(fertilizers)
            const product = fertilizers.find(fert => fert.id === selectedProduct);

            if (product) {
                console.log(product);
                document.getElementById("popupTitle").innerText = product.name;
                document.getElementById("popupDetails").innerHTML = `
                <div class="product-card">
                    <img src="${product.image}" alt="${product.name}" class="product-image">
                    <div class="product-info">
                        <p><strong>Unsur Hara:</strong> ${product.nutrients}</p>
                        <p><strong>Jenis Lahan:</strong> ${product.land_type}</p>
                        <p><strong>Umur Tanaman:</strong> ${product.age}</p>
                        <p><strong>Kondisi:</strong> ${product.condition}</p>
                        <p><strong>Harga:</strong> ${product.price}</p>
                        <p><strong>Manfaat:</strong> ${product.benefit}</p>
                    </div>
                </div>
            `;
                document.getElementById("popup").style.display = "flex";
            } else {
                alert("Produk tidak ditemukan.");
            }
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        // Function to convert Google Drive link to thumbnail URL
        function getImageUrl(driveUrl) {
            const idMatch = driveUrl.match(/id=([a-zA-Z0-9_-]+)/);
            if (idMatch && idMatch[1]) {
                return `https://drive.google.com/thumbnail?id=${idMatch[1]}`;
            }
            return driveUrl; // Return original URL if no match found
        }

        // Add Product Function
        function addProduct() {
            const newProduct = {
                id: document.getElementById("productId").value,
                name: document.getElementById("productName").value,
                nutrients: document.getElementById("chemicalContent").value,
                land_type: document.getElementById("landTypeInput").value,
                age: document.getElementById("plantAgeInput").value,
                condition: document.getElementById("conditionInput").value,
                price: document.getElementById("priceInput").value,
                benefit: document.getElementById("benefitInput").value,
                image: document.getElementById("imageInput").value
            };

            // Save the new product to the fertilizers list
            fertilizers.push(newProduct);

            // Update the productType dropdown
            updateProductTypeDropdown();

            alert("Produk berhasil ditambahkan!");
            closeProductInput(); // Close the product input popup
        }

        // Function to update productType dropdown
        function updateProductTypeDropdown() {
            const productTypeDropdown = document.getElementById("productType");
            productTypeDropdown.innerHTML = '<option value="">Pilih jenis produk</option>'; // Reset options
            fertilizers.forEach(product => {
                const option = document.createElement("option");
                option.value = product.id;
                option.textContent = product.name;
                productTypeDropdown.appendChild(option);
            });
        }

        // Delete Product Function
        function deleteProduct() {
            const productId = prompt("Masukkan ID produk yang ingin dihapus:");
            if (!productId) {
                alert("ID produk tidak boleh kosong!");
                return;
            }

            const productIndex = fertilizers.findIndex(product => product.id === productId);
            if (productIndex !== -1) {
                fertilizers.splice(productIndex, 1);
                updateProductTypeDropdown(); // Update the dropdown after deletion
                alert(`Produk dengan ID ${productId} berhasil dihapus!`);
            } else {
                alert(`Produk dengan ID ${productId} tidak ditemukan!`);
            }
        }

        function findFertilizer() {
            const inputs = {
                landType: document.getElementById("landType").value.toLowerCase(),
                plantAge: document.getElementById("plantAge").value.toLowerCase(),
                lastFertilizer: document.getElementById("lastFertilizer").value.toLowerCase(),
                landCond: document.getElementById("landCond").value.toLowerCase()
            };

            const emptyFields = Object.entries(inputs)
                .filter(([_, value]) => !value)
                .map(([key, _]) => key);

            if (emptyFields.length > 0) {
                const fieldNames = {
                    landType: "jenis lahan",
                    plantAge: "umur tanaman",
                    lastFertilizer: "pupuk terakhir",
                    landCond: "kondisi lahan"
                };
                alert(`Mohon lengkapi: ${emptyFields.map(field => fieldNames[field]).join(", ")}`);
                return;
            }

            const resultsDiv = document.getElementById("results");
            resultsDiv.innerHTML = "";

            const matchingFertilizers = fertilizers.filter(fertilizer => {
                return (
                    (fertilizer.land_type.toLowerCase() === inputs.landType.toLowerCase() ||
                        fertilizer.land_type.toLowerCase() === "semua jenis lahan") &&
                    (fertilizer.age.includes(inputs.plantAge) ||
                        fertilizer.age === "Semua umur") &&
                    (fertilizer.condition.includes(inputs.landCond) ||
                        fertilizer.condition === "Semua kondisi")
                );
            });

            if (matchingFertilizers.length > 0) {
                resultsDiv.innerHTML = `
                <h3>Rekomendasi Pupuk yang Sesuai</h3>
                ${matchingFertilizers.map(fert => `
                                                            <div class="product-card">
                                                                <img src="${getImageUrl(fert.image)}" alt="${fert.name}" class="product-image">
                                                                <div class="product-info">
                                                                    <h4>${fert.name}</h4>
                                                                    <p><strong>Unsur Hara:</strong> ${fert.nutrients}</p>
                                                                    <p><strong>Jenis Lahan:</strong> ${fert.land_type}</p>
                                                                    <p><strong>Umur Tanaman:</strong> ${fert.age}</p>
                                                                    <p><strong>Kondisi:</strong> ${fert.condition}</p>
                                                                    <p><strong>Harga:</strong> ${fert.price}</p>
                                                                    <p><strong>Manfaat:</strong> ${fert.benefit}</p>
                                                                </div>
                                                            </div>
                                                        `).join('')}
            `;
            } else {
                resultsDiv.innerHTML = `
                <div class="product-card">
                    <p>Tidak ditemukan pupuk yang sesuai dengan kriteria yang dipilih.</p>
                    <p>Silakan hubungi konsultan kami untuk rekomendasi khusus.</p>
                </div>
            `;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                title: "Gagal",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif
</body>

</html>
