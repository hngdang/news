# Hệ thống đọc tin tức

## Link truy cập

Link web: https://news-php.herokuapp.com
<br>
Email: tranhoangdang1402@gmail.com
<br>
Mật khẩu: 12345678
<br>
<br>
Link web CMS: https://news-php.herokuapp.com/admin
<br>
Email: tranhoangdang1402@gmail.com
<br>
Mật khẩu: 12345678
<br>

## Mô tả hệ thống

Hệ thống đọc tin tức bao gồm 2 người dùng chính là quản trị viên và khách hàng.<br>
Khi đăng nhập vào trang quản trị viên thành công, quản trị viên sẽ có những chức năng chính bao gồm:

- Đăng nhập: Quản trị viên bắt buộc phải đăng nhập trước khi vào được hệ thống, nếu đã đăng nhập chuyển đến trang chủ
- Tìm kiếm: tìm theo tên danh mục, tên chủ đề, tiêu đề bài báo, tên nhân viên, tên khách hàng
- Quản lý danh mục: thêm, xóa, sửa danh mục
- Quản lý chủ đề: thêm, xóa, sửa chủ đề
- Quản lý tin tức: thêm, xóa, sửa tin tức
- Quản lý nhân sự: thêm , xóa, sửa nhân viên
- Quản lý độc giả: xem danh sách và quản lý khóa tài khoản độc giả
- Quản lý thông tin cá nhân: cập nhật thông tin cá nhân
- Đổi mật khẩu
  <br>Khi đăng nhập vào tin tức, khách hàng sẽ có những chức năng chính bao gồm:<br>
- Tìm kiểm: tìm kiếm theo tiêu đề bài báo
- Xem tin tức theo danh mục
- Xem tin tức theo chủ đề
- Xem nội dung chi tiết bài báo
- Thêm yêu thích bài báo: người dùng cần đăng nhập để yêu thích bài báo, nếu đã đăng nhập bài báo sẽ được thêm vào danh sách yêu thích, nếu chưa sẽ chuyển đến trang đăng nhập
- Xem danh sách bài báo đã yêu thích
- Đăng nhập
- Đăng ký: khi đăng ký, hệ thống sẽ kiểm tra email tồn tài hay chưa. Nếu đã tồn tài, gửi thông báo email đã tồn tài. Nếu chưa, đăng ký email và gửi link xác nhận tài khoản qua mail với email mà khách hàng vừa đăng ký. Khi người dùng truy cập vào đúng link có mã token sẽ được xác nhận tài khoản và chuyển đến trang đăng nhập. Nếu email chưa được xác nhận, sẽ không thể đăng nhập thành công.
- Quên mật khẩu: Khách hàng sẽ nhập email đã đăng ký, hệ thống kiểm tra email này. Nếu tồn tài email, gửi đến email khách hàng một mã token, người dùng truy cập link này để truy cập đến trang đổi mật khẩu. Nếu link truy cập không đúng sẽ trả về trang quên mật khẩu.
- Đổi mật khẩu

## Hướng dẫn chạy source code

Tải source code vào htdocs trong XAMPP<br>
Nhập file database/news.sql vào phpMyadmin<br>
Cấu hình lại thông tin của db trong dile database/conn.php<br>
Mở trình duyệt và chạy localhost/news
