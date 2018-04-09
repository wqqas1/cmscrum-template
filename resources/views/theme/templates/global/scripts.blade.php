<!-- Mixpanel -->
<script type="text/javascript">
    @if(env('ENABLE_MIXPANEL') == true) {
    (function (e, a) {
        if (!a.__SV) {
            var b = window;
            try {
                var c, l, i, j = b.location, g = j.hash;
                c = function (a, b) {
                    return (l = a.match(RegExp(b + "=([^&]*)"))) ? l[1] : null
                };
                g && c(g, "state") && (i = JSON.parse(decodeURIComponent(c(g, "state"))), "mpeditor" === i.action && (b.sessionStorage.setItem("_mpcehash", g), history.replaceState(i.desiredHash || "", e.title, j.pathname + j.search)))
            } catch (m) {
            }
            var k, h;
            window.mixpanel = a;
            a._i = [];
            a.init = function (b, c, f) {
                function e(b, a) {
                    var c = a.split(".");
                    2 == c.length && (b = b[c[0]], a = c[1]);
                    b[a] = function () {
                        b.push([a].concat(Array.prototype.slice.call(arguments,
                            0)))
                    }
                }

                var d = a;
                "undefined" !== typeof f ? d = a[f] = [] : f = "mixpanel";
                d.people = d.people || [];
                d.toString = function (b) {
                    var a = "mixpanel";
                    "mixpanel" !== f && (a += "." + f);
                    b || (a += " (stub)");
                    return a
                };
                d.people.toString = function () {
                    return d.toString(1) + ".people (stub)"
                };
                k = "disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
                for (h = 0; h < k.length; h++)e(d, k[h]);
                a._i.push([b, c, f])
            };
            a.__SV = 1.2;
            b = e.createElement("script");
            b.type = "text/javascript";
            b.async = !0;
            b.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === e.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
            c = e.getElementsByTagName("script")[0];
            c.parentNode.insertBefore(b, c)
        }
    })(document, window.mixpanel || []);
    mixpanel.init("c3af8ab4b008e22adf4772978aca66ec");
    @endif


    function clickEvent(id, name, title, url, type, src, text){
        <?php if(env('ENABLE_MIXPANEL') == true) { ?>
        mixpanel.track("click", {
            "id": id,
            "name": name,
            "title": title,
            "url": url,
            "type": type,
            "src": src,
            "text": text
        });
        <?php } ?>
        $.get('/api/analytics/event', { event_type:'click',  <?php if(\Auth::user()) { $user = \Auth::user(); echo "user_id:$user->id, user_email:'$user->email', user_name:'$user->name',"; } ?> data: { id:id, name:name, title:title, url:url, type:type, src:src, text:text } }, function(data) {
        });
        return false; // prevent default
    }

    $( document ).ready(function() {
        // Track all clicks
        $( "a, button, .btn, input, img" ).click(function() {
            var id = $(this).attr('id');
            var name = $(this).attr('name');
            var title = $(this).attr('title');
            var url = $(this).attr('href');
            var type = $(this).attr('type');
            var src = $(this).attr('src');
            var text = $(this).html();
            clickEvent(id, name, title, url, type, src, text);
        });

        $( ".scroll-to" ).click(function() {
            var element = $(this).data('scroll-target');
            $(element).scrollTo();
        });

        // Open all external links in a new tab/window
        $("a[href^='http://']").attr("target","_blank");
        $("a[href^='https://']").attr("target","_blank");
    });

</script>

<!-- Font Awesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.1/js/all.js"></script>

<!-- Custom Scripts -->
<?php if(setting('theme.global_scripts') !== null) { echo setting('theme.global_scripts'); } ?>