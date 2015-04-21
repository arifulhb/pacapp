<section class="panel scancard">
    <header class="panel-heading text-center h1">Login</header>
    <div class="panel-body">
        <form role="form" method="POST" class="keypad"
              action="<?php echo base_url().'login/verification'?>" >
            <div class="form-group">
                <label for="exampleInputEmail1" class="sr-only">Enter Pin</label>
                <input type="text" class="form-control input-lg text-center key_display" id="inputPin"
                       name="inputPin" placeholder="Enter Your PIN Number">
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-1">1</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-2">2</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-3">3</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-4">4</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-5">5</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-6">6</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-7">7</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-8">8</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-9">9</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key-back">Back</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key  key-0">0</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-block btn-default btn-lg key-clear">Clear</a>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
        </form>

    </div>
</section>
<script> require(['page/front_loginexampleInputEmail1']); </script> 