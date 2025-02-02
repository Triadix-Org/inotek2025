WebFont.load({
    google: {
        families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic", "Poppins:regular,600"]
    }
});

!function (o, c) {
    var n = c.documentElement,
        t = " w-mod-";
    n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
}(window, document);