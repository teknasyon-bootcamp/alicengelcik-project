Merhabalar,

Bu proje bitirme projesi olarak hazırlanmıştır.

Arayüz(Front-End) tarafı;<br>
1-Üst kısımda tüm kategoriler sıralandı<br>
2-Anasayfaya tüm haberlerin gelmesi sağlandı.<br>
3-Anasayfada giriş/kayıt butonları eklendi.<br>
4-Anasayfaya kullanıcının son görüntülediği haberlerden 5 tanesini getiren alan eklendi.<br>
5-Haber detaylarını görüntüleme haberlerin altındaki Read More butonundan yapılıyor.<br><br>


Yönetim Paneli tarafı;<br><br>

1-localhost/admin şeklinde giriş yapılıyor.<br>
2-Giriş için 4 kullanıcı bilgileri aşağıdaki gibidir.<br>
3-Rollere uygun şekile menü erişimleri sağlandı.<br>
4-Rol düzenleme, kategori atama gibi yönetimsel işlemler yetki seviyelerine göre ayrıldı.<br>
5-Kategorilerine göre uygun şekilde haber ekleme sağlandı.<br>
6-Sitedeki haberlere yapılan yorumlar onay sistemine bağlandı.<br>
7-Account Management kısmında kullanıcılardan gelen hesap silme isteklerinin onay işlemleri yapıldı.<br>
8-Config kısmında haber düzenleme süresinin yıl ve gün şekilde seçilebilmesi,haber eklenme tarihine göre edit/delete butonlarının pasif edilmesi sağlandı.<br>
<br>
Genel yapılanlar;<br>
1-Güvenlik için inputlardan gelen verileri temizlemek için inputCleaner fonksiyonu kullanıldı<br>
2-Controller lara gelen POST ve GET istekleri için csrf_token zorunlu kılındı<br>
3-Site ve panel kısmının login girişleri ayrı ayrı logoutlarınında ayrı ayrı olması sağlandı.<br>
<br>
Eksikler;<br>
1-RestAPI<br>
2-Loglama<br>

Kullanıcı bilgileri;<br>
*admin@admin.com
parola:admin

*moderator@moderator.com
parola: moderator

*editor@editor.com
parola: editor

*user@user.com
parola: user
