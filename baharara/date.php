<link rel="stylesheet" href="./lib/css/bootstrap-rtl.min.css">
<script src="emp/js/jquery.min.js"></script>

<style>
@font-face {
  font-family: IranSans;
  src: url("./emp/fonts/IRANSansWeb(FaNum).eot");
  src: url("./emp/fonts/IRANSansWeb(FaNum).ttf") format("truetype");
}

body{
font-family:'iransans';
}
    .f{
    margin: 10% auto;
    border: 1px solid silver;
    width: max-content;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 5px silver;
    font-family: 'iransans';
    }
    
    input{
    	text-align:center;
    	letter-spacing: 1rem;
    }
    
    button{
        width:100%;
    }
</style>  

<div class="f">
    <label for="start">تاریخ مبنا
    <input type="text" id="start" value=""/>
    </label>
    
    <br/><br/>
    
    <label for="end">تاریخ چک
    <input type="text" id="end" value=""/>
    </label>
    
    <br><br>
    
    <label for="end">فاصله زمانی
    <input type="text" id="cal"/>
    </label>
    
    <button id="but" class="btn btn-primary">محاسبه</button>
</div>

<script>
$('#but').click(function(){
    start_year = $('#start').val().substring(0,4);
    start_month = $('#start').val().substring(4,6);
    start_day = $('#start').val().substring(6);
    
    end_year = $('#end').val().substring(0,4);
    end_month = $('#end').val().substring(4,6);
    end_day = $('#end').val().substring(6);
    
    var d1 = Number(30 - start_day) + Number(end_day);
    var m1 = (12 - Number(start_month)) * 30;
    var m2 = (Number(end_month) - 1) * 30;
    
    $('#cal').val(d1 + m1 + m2);
});
    
</script>