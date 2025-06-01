# 🏭 SimpleMRP: Manufacturing Resource Planning & Production Management System

---

## 💡 Gambaran Umum Project

**SimpleMRP** adalah sebuah sistem manajemen terintegrasi yang dirancang untuk membantu UMKM atau bisnis dalam mengelola proses produksi, penjualan, dan pembelian secara efisien. Dengan fokus pada **perencanaan kebutuhan material (MRP)**, sistem ini memungkinkan Anda untuk melacak inventaris 📦, mengelola daftar material (BOM) 📋, mensimulasikan biaya produksi 💲, dan secara otomatis menghasilkan rekomendasi pembelian berdasarkan pesanan penjualan dan ketersediaan stok.

Dibangun dengan **Laravel** sebagai backend yang robust 🚀, sistem ini menggunakan **Laravel AdminLTE** untuk antarmuka pengguna yang modern dan **PostgreSQL** sebagai database yang andal. Pengelolaan hak akses yang fleksibel diimplementasikan dengan **Spatie Permission**, dan data disajikan secara interaktif menggunakan **Datatables AJAX** dengan server-side rendering untuk performa optimal.

## ✨ Fitur Utama

Sistem ini terbagi menjadi beberapa modul inti yang bekerja sama untuk mengoptimalkan operasional bisnis Anda:

### ⚙️ Modul Engineering

-   **Item Master**: Mengelola daftar lengkap item atau produk Anda, dikategorikan menjadi _Supporting_, _Work-in-Progress (WIP)_, dan _Finished Goods (FG)_.
-   **Bill of Material (BOM)**: Membuat dan mengelola formula produksi (resep) yang bersifat multi-level untuk setiap item FG atau WIP.
-   **BOM Calculator**: Melakukan simulasi perhitungan biaya dan kebutuhan material berdasarkan BOM yang sudah ada.

### 💰 Modul Sales

-   **Sales Order (SO)**: Mencatat pesanan penjualan dari pelanggan 🤝. Setiap entri Sales Order untuk Finished Goods akan secara otomatis memicu pembuatan _Order Detail Material Master (ODM MSTR)_ berdasarkan BOM yang relevan.

### 🛒 Modul Purchasing

-   **Purchase Order (PO)**: Mengelola pesanan pembelian untuk bahan baku atau item lainnya.

### 📊 Modul PPIC (Production Planning and Inventory Control)

-   **Material Requisition Planning (MRP)**: Ini adalah inti dari project ini. Modul MRP akan menganalisis Order Detail Material Master (ODM MSTR) yang berasal dari Sales Order. Berdasarkan analisis ini, sistem akan menghasilkan daftar rekomendasi bahan baku yang perlu dibeli, dengan mempertimbangkan stok yang tersedia dan Purchase Order (PO) yang masih outstanding. Ini menghasilkan saran Material Requisition (MR) untuk pembelian bahan baku.
-   **Inventory Detail**: Melihat detail inventaris dan pergerakan stok.

### 🔒 Config

-   **User Access**: Mengelola pengguna, peran (roles), dan izin (permissions) untuk memastikan kontrol akses yang ketat dan fleksibel menggunakan Spatie Permission.

## 🔄 Alur Kerja Singkat

1.  **Item Master** & **Bill of Material (BOM)** diatur untuk mendefinisikan produk dan strukturnya.
2.  **Sales Order** masuk untuk item _Finished Goods_ 🛒.
3.  Sistem secara otomatis menghasilkan **Order Detail Material Master (ODM MSTR)** berdasarkan BOM dari Sales Order tersebut.
4.  PPIC menjalankan **Material Requisition Planning (MRP)** 📈.
5.  MRP menganalisis ODM MSTR, mengurangkan kebutuhan dengan stok yang tersedia (**Inventory Detail**) dan **Outstanding PO**.
6.  Hasilnya adalah daftar sugesti **Material Requisition (MR)** yang menunjukkan bahan baku apa saja yang perlu dibeli untuk memenuhi Sales Order 📝.

## 🛠️ Tech Stack

-   **Backend**: Laravel Framework
-   **Frontend**: Laravel AdminLTE (jeroennoten)
-   **Database**: PostgreSQL
-   **Authorization**: Spatie Permission
-   **Data Table**: Datatables AJAX (Server-side rendering)

---

Silakan hubungi saya jika Anda memiliki pertanyaan atau ingin berkontribusi! 👋
