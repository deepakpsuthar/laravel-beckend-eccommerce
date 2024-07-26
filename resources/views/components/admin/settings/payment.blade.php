
<div class="card">
    <div class="card-header">
        <h2>{{__('Payments Setting')}}</h2>
    </div>
    <div class="card-body">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-paypal-tab" data-bs-toggle="pill" data-bs-target="#pills-paypal" type="button" role="tab" aria-controls="pills-paypal" aria-selected="true">{{__('Paypal')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-banktransfer-tab" data-bs-toggle="pill" data-bs-target="#pills-banktransfer" type="button" role="tab" aria-controls="pills-banktransfer" aria-selected="false">{{__('Bank Transfer')}}</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-paypal" role="tabpanel" aria-labelledby="pills-paypal-tab">
                        Paypal
                    </div>
                    <div class="tab-pane fade" id="pills-banktransfer" role="tabpanel" aria-labelledby="pills-banktransfer-tab">
                        Bank Transfer
                    </div>
                  </div>
            </form>
        </div>
    </div>
</div>
