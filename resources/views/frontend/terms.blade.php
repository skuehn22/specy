@extends('frontend.masters.master-trustfy')

@section('seo')
    <title>{!! trans('seo.title_terms') !!}</title>
    <meta name="description" content="{!! trans('seo.desc_terms') !!}">
@endsection
@section('content')
    <div class="container content-container">
        <br><br>
        <div class="row terms-container" style="padding-top:70px; padding-bottom: 60px;">
            <div class="col-md-12">
               <h1>Terms and Conditions</h1>
                <p style="padding-top: 15px;">
                    Trustfy.io is a service of Freelance Flow Ltd
                </p>
                <p>
                    By using our services you are agreeing to our Terms & Conditions,Privacy Policy and the Terms of our Affiliates.
                </p>

               <p style="padding-bottom:1px; padding-top:15px;"><a href="/terms-detail">Freelance Flow Ltd Terms and Conditions</a></p>
               <p style="padding-bottom:1px;"><a href="/uploads/PSP_MANGOPAY_EN.pdf" target="_blank">Payment Provider - Mangopay Terms and Conditions</a></p>
               <p><a href="/en/privacy">Privacy</a></p>

            </div>
        </div>
    </div>
@endsection
