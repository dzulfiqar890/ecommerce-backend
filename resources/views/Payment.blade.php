<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout – DigiCart</title>

    <!-- Font Awesome untuk ikon -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-pVZhw+WJWgJKBG7BbqSgXbK6YFZk5vHqeHnW3u1v3nUI49VQpUQ8jXcTfoQ2gAGE+K4fF5xggb8cJ5f1oC1c4g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans bg-gray-50">
    <!-- ================= HEADER ================= -->
    <header class="bg-blue-900 text-white">
      <div class="container mx-auto flex items-center p-4 space-x-4">
        <a href="/home" class="flex items-center">
          <img
            src="Love Minimal Online Shopping Free Logo (2) 2.png"
            alt="DigiCart Logo"
            class="h-8"
          />
          <span class="text-xl font-bold ml-2">DigiCart</span>
        </a>
        <div class="flex-1">
          <div class="relative">
            <input
              type="text"
              placeholder="Search for anything..."
              class="w-full pl-10 pr-4 py-2 rounded-md text-black"
            />
            <i class="fa fa-search absolute left-3 top-2.5 text-gray-400"></i>
          </div>
        </div>
        <div class="flex items-center space-x-4">
          <a href="#" class="relative">
            <i class="fa fa-shopping-cart text-xl"></i>
            <span
              class="absolute -top-2 -right-2 bg-yellow-400 text-black text-xs px-1 rounded-full"
              >2</span
            >
          </a>
          <a href="#"><i class="fa fa-heart text-xl"></i></a>
          <a href="#"><i class="fa fa-user text-xl"></i></a>
        </div>
      </div>
    </header>
    <!-- =============== END HEADER =============== -->

    <!-- ======= MAIN CONTENT ======= -->
    <main class="container mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">
      <!-- LEFT COLUMN: FORM BILLING & PAYMENT OPTION -->
      <section class="flex-1 bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6">Billing Address</h2>
        <form action="#" method="POST" class="space-y-6">
          <!-- First & Last Name -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div>
              <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                First Name
              </label>
              <input
                type="text"
                id="first_name"
                name="first_name"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="First name"
              />
            </div>
            <div>
              <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                Last Name
              </label>
              <input
                type="text"
                id="last_name"
                name="last_name"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Last name"
              />
            </div>
          </div>

          <!-- Phone Number -->
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
              Phone Number
            </label>
            <input
              type="tel"
              id="phone"
              name="phone"
              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
              placeholder="(e.g. +62 812 3456 7890)"
            />
          </div>

          <!-- Email Address -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
              Email Address
            </label>
            <input
              type="email"
              id="email"
              name="email"
              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
              placeholder="you@example.com"
            />
          </div>

          <!-- Country, Region/State, City, Zip Code -->
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div>
              <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                Country
              </label>
              <select
                id="country"
                name="country"
                class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              >
                <option value="" disabled selected>Select...</option>
                <option>Indonesia</option>
                <option>United States</option>
                <option>Singapore</option>
                <!-- dst… -->
              </select>
            </div>
            <div>
              <label for="state" class="block text-sm font-medium text-gray-700 mb-1">
                Region/State
              </label>
              <select
                id="state"
                name="state"
                class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              >
                <option value="" disabled selected>Select...</option>
                <option>Jakarta</option>
                <option>Jawa Barat</option>
                <option>Jawa Timur</option>
                <!-- dst… -->
              </select>
            </div>
            <div>
              <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                City
              </label>
              <select
                id="city"
                name="city"
                class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              >
                <option value="" disabled selected>Select...</option>
                <option>Jakarta Selatan</option>
                <option>Bandung</option>
                <option>Surabaya</option>
                <!-- dst… -->
              </select>
            </div>
            <div>
              <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">
                Zip Code
              </label>
              <input
                type="text"
                id="zip"
                name="zip"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="12345"
              />
            </div>
          </div>

          <!-- Ship to different address -->
          <div class="flex items-center space-x-2">
            <input
              type="checkbox"
              id="ship_diff"
              name="ship_diff"
              class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-400"
            />
            <label for="ship_diff" class="text-sm text-gray-700">
              Ship into different address
            </label>
          </div>

          <!-- ========== Payment Option ========== -->
          <div class="border border-gray-200 rounded-lg p-4 mt-6">
            <h3 class="text-lg font-semibold mb-4">Payment Option</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
              <!-- Cash on Delivery -->
              <label
                class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition"
              >
                <i class="fas fa-dollar-sign text-2xl text-gray-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700 mb-2">Cash on Delivery</span>
                <input
                  type="radio"
                  name="payment_method"
                  value="cod"
                  class="form-radio h-4 w-4 text-blue-600"
                />
              </label>

              <!-- Venmo -->
              <label
                class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition"
              >
                <i class="fab fa-venmo text-2xl text-gray-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700 mb-2">Venmo</span>
                <input
                  type="radio"
                  name="payment_method"
                  value="venmo"
                  class="form-radio h-4 w-4 text-blue-600"
                />
              </label>

              <!-- PayPal (default selected) -->
              <label
                class="flex flex-col items-center justify-center p-4 border-2 border-blue-500 rounded-lg bg-blue-50 cursor-pointer transition"
              >
                <i class="fab fa-paypal text-2xl text-blue-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700 mb-2">PayPal</span>
                <input
                  type="radio"
                  name="payment_method"
                  value="paypal"
                  class="form-radio h-4 w-4 text-blue-600"
                  checked
                />
              </label>

              <!-- Amazon Pay -->
              <label
                class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition"
              >
                <i class="fab fa-amazon text-2xl text-gray-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700 mb-2">Amazon Pay</span>
                <input
                  type="radio"
                  name="payment_method"
                  value="amazon"
                  class="form-radio h-4 w-4 text-blue-600"
                />
              </label>
            </div>

            <!-- Card Details (default ditampilkan; nanti bisa kita hide/show via JS) -->
            <div id="card-fields" class="grid grid-cols-1 lg:grid-cols-2 gap-4">
              <div>
                <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">
                  Card Number
                </label>
                <input
                  type="text"
                  id="card_number"
                  name="card_number"
                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="1234 5678 9012 3456"
                />
              </div>
              <div>
                <label for="name_on_card" class="block text-sm font-medium text-gray-700 mb-1">
                  Name on Card
                </label>
                <input
                  type="text"
                  id="name_on_card"
                  name="name_on_card"
                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="Cardholder Name"
                />
              </div>
              <div>
                <label for="exp_date" class="block text-sm font-medium text-gray-700 mb-1">
                  Expire Date
                </label>
                <input
                  type="text"
                  id="exp_date"
                  name="exp_date"
                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="MM/YY"
                />
              </div>
              <div>
                <label for="cvc" class="block text-sm font-medium text-gray-700 mb-1">
                  CVC
                </label>
                <input
                  type="text"
                  id="cvc"
                  name="cvc"
                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="123"
                />
              </div>
            </div>
          </div>

          <!-- Additional Information -->
          <div>
            <h3 class="text-lg font-semibold mb-2">Additional Information</h3>
            <label for="order_notes" class="block text-sm font-medium text-gray-700 mb-1">
              Order Notes <span class="text-sm text-gray-400">(Optional)</span>
            </label>
            <textarea
              id="order_notes"
              name="order_notes"
              rows="4"
              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
              placeholder="Notes about your order, e.g. special notes for delivery"
            ></textarea>
          </div>

        </form>
      </section>

      <!-- RIGHT COLUMN: ORDER SUMMARY (akan disebut “containerSummary”) -->
      <aside class="w-full lg:w-1/3">
        <div
          class="bg-white p-6 rounded-lg shadow space-y-6"
          id="containerSummary"
        >
          <!-- Judul -->
          <h2 class="text-2xl font-semibold">Order Summary</h2>

          <!-- CONTAINER UNTUK DAFTAR ITEM (akan diisi oleh JS) -->
          <div id="itemsContainer" class="space-y-4"></div>

          <!-- RINGKASAN HARGA -->
          <div id="priceSummary" class="border-t border-gray-200 pt-4 space-y-2">
            <!-- Sub-total, Shipping, Discount, Tax, Total -- akan di‐populate oleh JS -->
          </div>

          <!-- TOMBOL PLACE ORDER -->
          <button
            id="placeOrderBtn"
            type="button"
            class="mt-4 w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-md flex items-center justify-center transition"
          >
            <span>PLACE ORDER</span>
            <i class="fas fa-arrow-right ml-2"></i>
          </button>
        </div>
      </aside>
    </main>
    <!-- ===== END MAIN CONTENT ===== -->

    <!-- ================ FOOTER ================ -->
    <footer class="bg-black text-white mt-10">
      <div class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <img
            src="logo or.png"
            alt="DigiCart Logo"
            class="h-8 mb-2"
          />
          <h3 class="text-2xl font-bold">DigiCart</h3>
          <p class="text-sm mt-2">
            DigiCart is an e-commerce website for shopping for electronics and 
            accessories with a simple and easy-to-use interface.
          </p>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Top Category</h4>
          <ul class="space-y-1 text-sm">
            <li>Computer & Laptop</li>
            <li>SmartPhone</li>
            <li>Headphone</li>
            <li>Accessories</li>
            <li>Camera & Photo</li>
            <li>TV & Homes</li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Quick Links</h4>
          <ul class="space-y-1 text-sm">
            <li>Shop Product</li>
            <li>Shopping Cart</li>
            <li>Wishlist</li>
            <li>Compare</li>
            <li>Track Order</li>
            <li>Customer Help</li>
            <li>About Us</li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Contact Us</h4>
          <ul class="space-y-1 text-sm">
            <li>digicart@gmail.com</li>
            <li>+62 850 3320 0890</li>
          </ul>
        </div>
      </div>
      <div class="text-center py-4 border-t border-gray-700">
        © 2025 DigiCart. All rights reserved
      </div>
    </footer>
    <!-- ============== END FOOTER ============== -->

    <!-- ========================================= -->
    <!-- SCRIPT: Parse URL & Inject ke Order Summary -->
    <!-- ========================================= -->
    <script>
      // 1. Fungsi untuk mengambil query params dari URL
      function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        return {
          name: params.get('name') || '',
          price: parseFloat(params.get('price')) || 0,
          img: params.get('img') || '',
          qty: parseInt(params.get('qty')) || 1
        };
      }

      // 2. Fungsi untuk membuat elemen HTML untuk setiap item di summary
      function renderItem({ name, price, img, qty }) {
        // Buat elemen container
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-center space-x-4';

        // Thumbnail gambar
        const imgElem = document.createElement('img');
        imgElem.src = img; // path menuju gambar (harus sesuai di server Anda)
        imgElem.alt = name;
        imgElem.className = 'w-16 h-16 object-cover rounded';

        // Deskripsi + harga per item
        const desc = document.createElement('div');
        desc.className = 'flex-1';

        const pName = document.createElement('p');
        pName.textContent = name;
        pName.className = 'text-sm font-medium';

        const pQtyPrice = document.createElement('p');
        pQtyPrice.textContent = `${qty} × $${price.toFixed(2)}`;
        pQtyPrice.className = 'text-sm text-gray-500';

        desc.appendChild(pName);
        desc.appendChild(pQtyPrice);

        wrapper.appendChild(imgElem);
        wrapper.appendChild(desc);

        return wrapper;
      }

      // 3. Fungsi untuk menghitung ringkasan harga (subtotal, tax, discount, total)
      function renderPriceSummary({ price, qty }) {
        // Untuk contoh sederhana:
        const subTotal = price * qty;
        const shipping = 0; // free shipping
        const discount = 0; // misalnya discount tetap 0 (atau bisa diambil dari param juga)
        const taxRate = 0.1; // misalnya 10% tax
        const tax = subTotal * taxRate;
        const total = subTotal + shipping + tax - discount;

        // Bangun elemen HTML
        const container = document.createElement('div');
        container.className = 'space-y-2';

        const row = (label, value, extraClass = '') => {
          const div = document.createElement('div');
          div.className = `flex justify-between text-gray-700 ${extraClass}`;
          const spanLabel = document.createElement('span');
          spanLabel.textContent = label;
          const spanValue = document.createElement('span');
          spanValue.textContent = value;
          div.appendChild(spanLabel);
          div.appendChild(spanValue);
          return div;
        };

        container.appendChild(row('Sub-total', `$${subTotal.toFixed(2)}`));
        container.appendChild(row('Shipping', shipping === 0 ? 'Free' : `$${shipping.toFixed(2)}`, shipping===0?'text-green-600 font-medium':''));
        container.appendChild(row('Discount', discount > 0 ? `− $${discount.toFixed(2)}` : `$0.00`, discount>0?'text-red-500':''));
        container.appendChild(row('Tax', `$${tax.toFixed(2)}`));
        container.appendChild(row('Total', `$${total.toFixed(2)} USD`, 'text-xl font-bold mt-2'));

        return container;
      }

      // 4. Ketika halaman selesai dimuat, ambil param dan render
      document.addEventListener('DOMContentLoaded', () => {
        const params = getQueryParams();
        const itemsContainer = document.getElementById('itemsContainer');
        const priceSummary = document.getElementById('priceSummary');

        // Render satu item (karena kita asumsikan 1 produk per klik)
        const itemElem = renderItem(params);
        itemsContainer.appendChild(itemElem);

        // Render ringkasan harga
        const priceElem = renderPriceSummary(params);
        priceSummary.appendChild(priceElem);

        // Jika ingin tombol “Place Order” mengarahkan ke proses selanjutnya,
        // bisa tambahkan listener:
        document.getElementById('placeOrderBtn').addEventListener('click', () => {
          // Contoh: bisa redirect ke thank-you page atau kirim form data
          alert('Order placed for: ' + params.name);
          // window.location.href = 'thankyou.html';
        });
      });
    </script>
  </body>
</html>
