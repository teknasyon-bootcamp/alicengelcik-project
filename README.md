Merhabalar,

Bu proje bitirme projesi olarak hazırlanmıştır.

Arayüz(Front-End) tarafı;
1-Üst kısımda tüm kategoriler sıralandı
2-Anasayfaya tüm haberlerin gelmesi sağlandı.
3-Anasayfada giriş/kayıt butonları eklendi.
4-Anasayfaya kullanıcının son görüntülediği haberlerden 5 tanesini getiren alan eklendi.
5-Haber detaylarını görüntüleme haberlerin altındaki Read More butonundan yapılıyor.


Yönetim Paneli tarafı;

1-localhost/admin şeklinde giriş yapılıyor.
2-Giriş için 4 kullanıcı bilgileri aşağıdaki gibidir.
3-Rollere uygun şekile menü erişimleri sağlandı.
4-Rol düzenleme, kategori atama gibi yönetimsel işlemler yetki seviyelerine göre ayrıldı.
5-Kategorilerine göre uygun şekilde haber ekleme sağlandı.
6-Sitedeki haberlere yapılan yorumlar onay sistemine bağlandı.
7-Account Management kısmında kullanıcılardan gelen hesap silme isteklerinin onay işlemleri yapıldı.
8-Config kısmında haber düzenleme süresinin yıl ve gün şekilde seçilebilmesi,haber eklenme tarihine göre edit/delete butonlarının pasif edilmesi sağlandı.

Genel yapılanlar;
1-Güvenlik için inputlardan gelen verileri temizlemek için inputCleaner fonksiyonu kullanıldı
2-Controller lara gelen POST ve GET istekleri için csrf_token zorunlu kılındı
3-Site ve panel kısmının login girişleri ayrı ayrı logoutlarınında ayrı ayrı olması sağlandı.

Eksikler;
1-RestAPI
2-Loglama

Kullanıcı bilgileri;
*admin@admin.com
parola:admin

*moderator@moderator.com
parola: moderator

*editor@editor.com
parola: editor

*user@user.com
parola: user
