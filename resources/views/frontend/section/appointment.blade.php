<!-- MAKE AN APPOINTMENT -->
<section id="appointment" data-stellar-background-ratio="3">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <img src="{{ asset('frontend/home/images/appointment-image.jpg') }}" class="img-responsive" alt="">
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- CONTACT FORM HERE -->
                <form id="appointment-form" role="form" method="post" action="#">

                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                        <h2>Đặt lịch</h2>
                    </div>

                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <div class="col-md-6 col-sm-6">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Họ và tên đầy đủ">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="date">Chọn ngày</label>
                            <input type="date" name="date" value="" class="form-control">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="select">Bệnh viện</label>
                            <select class="form-control">
                                <option>Bệnh viện Đa khoa Quốc tế Vinmec</option>
                                <option>Bệnh viện Đa Khoa tỉnh Khánh Hòa</option>
                                <option>Bệnh viện Ung Bướu Nha Trang</option>
                                <option>Bệnh viện Y học cổ truyền và Phục hồi chức năng tỉnh Khánh Hòa</option>
                                <option>Bệnh viện Quân y 87</option>
                                <option>Bệnh viện Lao và bệnh Phổi Nha Trang Khánh Hòa</option>
                                <option>Bệnh viện Đa khoa Yersin Nha Trang</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="telephone">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Số điện thoại di động">
                            <label for="Message">Ghi chú</label>
                            <textarea class="form-control" rows="5" id="message" name="message"
                                placeholder="Triệu chứng, thuốc đang dùng, tiền sử, ..."></textarea>
                            <button type="submit" class="form-control" id="cf-submit" name="submit">Đặt
                                lịch</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
