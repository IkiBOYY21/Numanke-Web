// assets/js/cart.js

let keranjang = [];
let totalHarga = 0;

function formatRupiah(angka) {
    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function tambahKeKeranjang(id, nama, harga) {
    // Cek apakah item sudah ada di keranjang
    let itemExist = keranjang.find(item => item.id === id);

    if (itemExist) {
        itemExist.qty += 1; // Jika ada, tambah jumlahnya
    } else {
        keranjang.push({ id: id, nama: nama, harga: harga, qty: 1 });
    }

    renderKeranjang();
}

function hapusItem(id) {
    keranjang = keranjang.filter(item => item.id !== id);
    renderKeranjang();
}

function renderKeranjang() {
    const cartItemsDiv = document.getElementById('cart-items');
    const cartTotalSpan = document.getElementById('cart-total');
    const checkoutForm = document.getElementById('checkout-form');
    const inputCartData = document.getElementById('cart_data');

    cartItemsDiv.innerHTML = ''; // Kosongkan tampilan keranjang
    totalHarga = 0;

    if (keranjang.length === 0) {
        cartItemsDiv.innerHTML = '<li class="empty-cart">Keranjang masih kosong</li>';
        checkoutForm.style.display = 'none'; // Sembunyikan form jika kosong
    } else {
        checkoutForm.style.display = 'block'; // Tampilkan form checkout

        keranjang.forEach(item => {
            let subtotal = item.harga * item.qty;
            totalHarga += subtotal;

            cartItemsDiv.innerHTML += `
                <li style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dashed #ccc;">
                    <div>
                        <strong>${item.nama}</strong><br>
                        <small>${item.qty} x Rp ${formatRupiah(item.harga)}</small>
                    </div>
                    <div style="text-align: right;">
                        <span>Rp ${formatRupiah(subtotal)}</span><br>
                        <button onclick="hapusItem(${item.id})" style="background: none; border: none; color: red; cursor: pointer; font-size: 12px; margin-top: 5px;">Hapus</button>
                    </div>
                </li>
            `;
        });
    }

    cartTotalSpan.innerText = formatRupiah(totalHarga);
    
    // Simpan data keranjang ke dalam input hidden berbentuk JSON untuk diproses oleh PHP nanti
    inputCartData.value = JSON.stringify(keranjang);
}