# yii2-daerah-indonesia

**Ekstensi Yii2 Berisi Daerah dan Kodepos Seluruh Indonesia**

Database daerah sesuai Permendagri no 39 tahun 2015.


Instalasi
---------

    composer require fredyns/yii2-daerah-indonesia:"@dev"

Kemudian import file .sql yg ada di folder `mysqldump`


Konfigurasi
-----------

Tambahkan konfigurasi berikut:

    'modules' => [
        'daerah-indonesia' => [
            'class' => 'fredyns\daerahIndonesia\Module',
        ],
    ],


Penggunaan
----------

Buka aplikasi anda melalui browser dan buka alamat `/daerah-indonesia`.
atau sesuaikan dgn konfigurasi module yg digunakan.

Pada halaman depan (`daerah-indonesia/default/index`) terdapat contoh formulir pengisian data daerah.
Input formnya menggunakan compobox bertingkat.
Menggunakan library `kartik-v/yii2-widget-select2`.

Pilih provinsi, lalu mmuncul opsi kota.
Pilih kota, lalu muncul opsi kecamatan.
Dan seterusnya.

Selain itu dimungkinkan untuk menambahkan wilayah baru yg belum terdaftar.
Nantinya aka ditangani oleh Class-Behavior yg otomatis meng-insert data baru.
Untuk mencoba, bisa memasukkan nomor kodepos dgn data wilayah yg baru semua.

Contohnya seperti berikut:

![giiant-0 2-screen-1](https://scontent-sin6-1.xx.fbcdn.net/v/t31.0-8/15936390_751102618376532_6915148262999836326_o.jpg?oh=6c3d553496ba0736bf95c433f896ea42&oe=58DCB5E2)


Ucapan terimakasih khusus untuk om Cahya yg saya copy [database daerahnya](https://github.com/cahyadsn/daerah) :D
Serta **edwinkun** yg saya copy data [kodeposnya](https://github.com/edwinkun/database-kodepos-seluruh-indonesia)
Keduanya sudah saya join supaya bisa lebih bermanfaat.


Dibuat oleh [fredyns](http://fredyns.net)
