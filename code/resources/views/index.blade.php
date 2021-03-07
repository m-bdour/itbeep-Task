<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <title>Document</title>

  <style>
      body {
        background-color: #f3f3f3;
        text-align: right;
      }
      .page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70%;
      }
      .my-form {
          width: 30rem;
          max-width: 100%;
      }
      input::placeholder {  
        text-align: right; 
      }

  </style>

</head>
<body>

  <section>
    <div class=" page col-12">
    <div class="my-form " >
      <form id="services_form"  onsubmit="event.preventDefault()">
        @csrf
        <div class="form-group ">
              <label> الاسم</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="محمد">
            </div>
            <div class="form-group">
              <label>الجوال</label>
              <input type="number" class="form-control " id="number" name="number" placeholder="07xxxxxxxx">
            </div>
            <div class="form-group">
              <label>البريد الالكتروني</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>
            <input type="hidden"  id="service" name="service">
            <input type="hidden" id="interest" name="interest">
    
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PopUp">ارسال  </button>
    
      <div class="modal fade" id="PopUp" tabindex="-1" role="dialog" aria-labelledby="PopUpTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">اختر علرض من العروض التالية</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @foreach($services as $service)
              <button class="btn" name="services" style="background:red" onclick="setServices('{{$service->name}}',event)" >
                {{$service->name}}
              </button>
              @endforeach
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PopUp2" id="firstModalButton" onclick="nextButton()">التالي</button>
            </div>
          </div>
        </div>
      </div>
    
      <div class="modal fade" id="PopUp2" tabindex="-1" role="dialog" aria-labelledby="PopUpTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">متى ترغب برفع الطلب</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @foreach($interests as $interest)
                  <button class="btn" name="interests" style="background:red" data-toggle="modal" data-target="#PopUp3" onclick="setInterests('{{$interest->name}}',event)" >
                    {{$interest->name}}
                  </button>
                @endforeach
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="PopUp3" tabindex="-1" role="dialog" aria-labelledby="PopUpTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"> تم ارسال المعلومات الى بريدك الالكتروني بنجاح</h5>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
          </div>
        </div>
      </div>
    
    </form>
    </div>
    </div>

    
  
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script>
    $("#firstModalButton").click(e => {
        e.preventDefault();
        $('#PopUp').modal('hide')
    });

    var services=[];
    function setServices(name,event){
      if(event.target.style.background=="red"){
        event.target.style.background="green";
        services.push(name);
      }
      else{
        event.target.style.background="red";
        services.splice(services.indexOf(name),1);
      }
    }
    function setInterests(name,event){
      $("#interest").val(name);
      data = new FormData($("#services_form").get(0));
      console.log(data);
      $.ajax({
            url: '{{ url("/sendEmail") }}',
            method: "POST",
            contentType:false,
            cache:false,
            processData:false,
            data: new FormData($("#services_form").get(0)),
            success: function(response) {
              console.log(response);
            }
        });
        $('#PopUp2').modal('hide');
    }


    function nextButton(){
      $("#service").val(services);
    }
  </script>
  
</body>
</html>

