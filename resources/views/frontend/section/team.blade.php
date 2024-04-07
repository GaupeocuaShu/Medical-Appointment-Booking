<!-- TEAM -->
<section id="team" data-stellar-background-ratio="1">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <div class="about-info">
                    <h2 class="wow fadeInUp" data-wow-delay="0.1s">Đặt khám bác sĩ</h2>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="doctors-scroll">
                @foreach ($doctors as $dr)
                    <div class="doctor-item">
                        <img src="{{ asset($dr->user->avatar) }}" class="img-responsive" alt="Bác sĩ 1">
                        <h4>{{ $dr->academic_degree }} {{ getFullName($dr->user) }}</h4>
                        <h5>
                            @foreach ($dr->specializations as $sp)
                                {{ ' ' . $sp->name }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach

                        </h5>
                        <p>{{ $dr->workplace->name }}</p>
                        <div><button data-url="{{ route('book-appointment', $dr->id) }}" class="book-appointment">Đặt
                                lịch</button></div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>



@push('scripts')
    <script>
        $(".book-appointment").on("click", function() {
            window.location.href = $(this).data("url");
        });
    </script>
@endpush
