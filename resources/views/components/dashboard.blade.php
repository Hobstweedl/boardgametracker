@extends('template')

@section('content')

<style>
body{
    cursor: url('img/crosshair.png'), default;
}
</style>
<div style="display: none;"><iframe width="560" height="315" src="https://www.youtube.com/embed/oRSijEW_cDM?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>
<div class="row">
    <div class="col-md-12">
        <h2 class="text-center"> <img src="img/explosion.gif-c200" >DASHBOARD<img src="img/explosion.gif-c200" ></h2> 

    </div>
</div>


<div class="row">
    <div class="col-md-12">

    <h1> MORE COMING SOON </h1>
    <h2>This will be the best site ever</h2>
    <h3>visit www.lemonparty.com for the latest in cool stuff</h3>
    <h4>I AM A HAXOR IN COUNTER STRIKE. FUKIN N00BZ CANT BEAT ME IN QUAKE</h4>
    <h5>Bacon ipsum dolor amet tail short loin venison </h5>
    <h5>cupim shankle alcatra biltong porchetta. Spare ribs picanha drumstick tenderloin brisket porchetta shankle bacon andouille swine </h5>
    <h5>kevin flank short ribs boudin. Corned beef shoulder rump, chuck picanha ball tip turducken meatloaf bacon. Alcatra brisket meatball tri-tip andouille, rump shank landjaeger ball tip sausage tail jerky.</h5>

    </div>
</div>

@stop

@section('charts')

<hr>
<div class="row">
    <div class="col-md-6">
        <div id="winchart"></div>
    </div>
    <div class="col-md-6">
        <div id="statchart"></div>
    </div>
</div>




@stop

@section('scripts')



<script>
    (function($) {
        $.fn.textWidth = function(){
             var calc = '<span style="display:none">' + $(this).text() + '</span>';
             $('body').append(calc);
             var width = $('body').find('span:last').width();
             $('body').find('span:last').remove();
            return width;
        };
        
        $.fn.marquee = function(args) {
            var that = $(this);
            var textWidth = that.textWidth(),
                offset = that.width(),
                width = offset,
                css = {
                    'text-indent' : that.css('text-indent'),
                    'overflow' : that.css('overflow'),
                    'white-space' : that.css('white-space')
                },
                marqueeCss = {
                    'text-indent' : width,
                    'overflow' : 'hidden',
                    'white-space' : 'nowrap'
                },
                args = $.extend(true, { count: -1, speed: 1e1, leftToRight: false }, args),
                i = 0,
                stop = textWidth*-1,
                dfd = $.Deferred();
            
            function go() {
                if(!that.length) return dfd.reject();
                if(width == stop) {
                    i++;
                    if(i == args.count) {
                        that.css(css);
                        return dfd.resolve();
                    }
                    if(args.leftToRight) {
                        width = textWidth*-1;
                    } else {
                        width = offset;
                    }
                }
                that.css('text-indent', width + 'px');
                if(args.leftToRight) {
                    width++;
                } else {
                    width--;
                }
                setTimeout(go, args.speed);
            };
            if(args.leftToRight) {
                width = textWidth*-1;
                width++;
                stop = offset;
            } else {
                width--;            
            }
            that.css(marqueeCss);
            go();
            return dfd.promise();
        };
    })(jQuery);

$('h1').marquee();
$('h2').marquee({ count: 2 });
$('h3').marquee({ speed: 5 });
$('h4').marquee({ leftToRight: true });
$('h5').marquee({ count: 1, speed: 2 }).done(function() { $('h5').css('color', '#f00'); })
</script>

@stop