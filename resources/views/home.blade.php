@extends('master')

@section('konten')
<?php

use App\Models\Kendaraan;
use Carbon\Carbon;

?>

<h4>Selamat Datang <b>{{Auth::user()->name}}</b>
    , Anda Login sebagai <b><?php if (Auth::user()->role == 1) { ?> ADMIN <?php } else { ?> <?php }
                                                                                        echo Route::current()->getName();
                                                                                            ?></b>

</h4>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                    @if(Session::has('sukses'))
                    <div class="alert alert-success">
                        {{ Session::get('sukses') }}
                    </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>






<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

</script>

<!--  -->

@endsection