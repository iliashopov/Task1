@include('headers.dashboard_h')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src="dashboardd/js/dashboard.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>
<body style="background-color:#E6E6E6">
    <h1 class="login100-form-title p-b-40">
        Welcome to dashboard
    </h1>

    <div class="container  mmcon">
        <div class="row  ma" id="rows_mm">
            @php $ii=0 @endphp
            @for ($i = 0; $i < count($data); $i++)

            <div id="item_{{$data[$i]['id']}}" md="editLink" tid="{{$data[$i]['id']}}" color="{{$data[$i]['color_bg']}}" user="{{$data[$i]['user_id']}}" class="col-sm mm {{$data[$i]['color_bg']}}" >               
                <a  href="{{$data[$i]['url_link']}}" color="{{$data[$i]['color_text']}}" target="{{$data[$i]['target']}}" class="{{$data[$i]['class']}} {{$data[$i]['color_text']}}">{{$data[$i]['text']}}</a> 
            </div>
            <div class="w5mm"></div>
            @if ($ii==2)
            @php $ii=-1 @endphp
            <div class="w-100"></div>
            @endif
            @php $ii++ @endphp

            @endfor
        </div>
        <!--
                <div id="ex1" class="modal">
                    <p>Thanks for clicking. That felt good.</p>
                    <a href="#" rel="modal:close">Close</a>
                </div>
        
              
                <p><a href="#ex1" rel="modal:open">Open Modal</a></p>
        
        
        -->

        <div class="alert edit-container" id="edit_container">
            <button type="button" class="close" md="hide_edit">×</button>




            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text s1mm" >URL</div>
                </div>
                <input type="text" id="url_edit" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text s1mm" >Text</div>
                </div>
                <input type="text" id="text_edit" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text s1mm" id="url_edit" >Color</div>
                </div>
                <select class="form-control bg-primary text-white" id="color_edit" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <option value="bg-primary" class="bg-primary text-white">primary</option>
                    <option value="bg-secondary" class="bg-secondary text-white">secondary</option>
                    <option value="bg-success" class="bg-success text-white">success</option>
                    <option value="bg-danger" class="bg-danger text-white">danger</option>
                    <option value="bg-warning" class="bg-warning text-dark">warning</option>
                    <option value="bg-info" class="bg-info text-white">info</option>
                </select>
            </div>


            <div class="">
                <button id="but_ok" md="send_ok" type="button" class="btn btn-secondary">Ok</button>
                <button  id="but_new" md="send_new" type="button" class="btn btn-success">Add new cell</button>
                <button id="but_remove" md="send_remove" type="button" class="btn btn-danger">Remove</button>
            </div>

        </div>





    </div>

    <!--
    <a class="btn" data-toggle="modal" href="#myModal">Launch Modal</a>


    <div class="modal hide" id="myModal">
        <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Modal header</h3>
        </div>
        <div class="modal-body">
            <p>One fine body…</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>​


    
            <div class="row ma">
                <div class="col-sm mm">
                    <i class="fa fa-plus-circle fa-2x"></i>
    
                </div>
                <div class="col-sm mm">
                    <i class="fa fa-plus-circle fa-2x"></i>
                </div>
                <div class="col-sm mm">
                    One of three columns
                </div>
            </div>
    
    
            <div class="row ma">
                <div class="col-sm mm">
                    <span class="fa fa-plus-circle fa-2x"></span>
                </div>
                <div class="col-sm mm">
                    One of three columns
                </div>
                <div class="col-sm mm">
                    One of three columns
                </div>
            </div>
    
            <div class="row ma">
                <div class="col-sm mm">
                    One of three columns
                </div>
                <div class="col-sm mm">
                    One of three columns
                </div>
                <div class="col-sm mm">
                    One of three columns
                </div>
            </div>
    -->


</body>
</html>

