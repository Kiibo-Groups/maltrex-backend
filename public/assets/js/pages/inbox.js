jQuery(document).ready(function(i) {
    var s = {},
        o = !1;
    s.showOverlay = function() {
        i("body").addClass("show-main-overlay")
    }, s.hideOverlay = function() {
        i("body").removeClass("show-main-overlay")
    }, s.showMessage = function() {
        i("body").addClass("show-message"), o = !0
    }, s.hideMessage = function() {
        i("body").removeClass("show-message"), i("#main .message-list li").removeClass("active"), o = !1
    }, s.showSidebar = function() {
        i("body").addClass("show-sidebar")
    }, s.hideSidebar = function() {
        i("body").removeClass("show-sidebar")
    }, i(".trigger-toggle-sidebar").on("click", function() {
        s.showSidebar(), s.showOverlay()
    }), i(".trigger-message-close").on("click", function() {
        s.hideMessage(), s.hideOverlay()
    }), i("#main .message-list li").on("click", function(t) {
        var e = i(this);
        i(t.target).is("label") ? e.toggleClass("selected") : o && e.is(".active") ? (s.hideMessage(), s.hideOverlay()) : (o ? (s.hideMessage(), e.addClass("active"), setTimeout(function() {
            s.showMessage()
        }, 300)) : (e.addClass("active"), s.showMessage()), s.showOverlay())
    }), i("#main > .overlay").on("click", function() {
        s.hideOverlay(), s.hideMessage(), s.hideSidebar()
    })
});

var quill = new Quill("#snow-editor", {
    theme: "snow",
    modules: {
        toolbar: [
            [{
                font: []
            }, {
                size: []
            }],
            ["bold", "italic", "underline"],
            [{
                color: []
            }, {
                background: []
            }],
            [{
                list: "ordered"
            }, {
                list: "bullet"
            }]
        ]
    }
});

! function(s, o, n) {
    "use strict";
    var c, p, i, h, a, e, d, g, l, r, u, v, f, S, t, m, y, b, w, T, $, x, C;

    function H(t, e) {
        this.el = t, this.options = e, p = p || y(), this.$el = s(this.el), this.doc = s(this.options.documentContext || n), this.win = s(this.options.windowContext || o), this.$content = this.$el.children("." + e.contentClass), this.$content.attr("tabindex", this.options.tabIndex || 0), this.content = this.$content[0], this.options.iOSNativeScrolling && null != this.el.style.WebkitOverflowScrolling ? this.nativeScrolling() : this.generate(), this.createEvents(), this.addEvents(), this.reset()
    }
    m = {
        paneClass: "nano-pane",
        sliderClass: "nano-slider",
        contentClass: "nano-content",
        iOSNativeScrolling: !1,
        preventPageScrolling: !1,
        disableResize: !1,
        alwaysVisible: !1,
        flashDelay: 1500,
        sliderMinHeight: 20,
        sliderMaxHeight: null,
        documentContext: null,
        windowContext: null
    }, v = "scroll", e = "mousedown", d = "mousemove", l = "mousewheel", g = "mouseup", u = "resize", a = "drag", S = "up", i = "DOMMouseScroll", h = "down", f = "touchmove", c = "Microsoft Internet Explorer" === o.navigator.appName && /msie 7./i.test(o.navigator.appVersion) && o.ActiveXObject, p = null, T = o.requestAnimationFrame, t = o.cancelAnimationFrame, x = n.createElement("div").style, C = function() {
        var t, e, i, s;
        for (t = i = 0, s = (e = ["t", "webkitT", "MozT", "msT", "OT"]).length; i < s; t = ++i)
            if (e[t], e[t] + "ransform" in x) return e[t].substr(0, e[t].length - 1);
        return !1
    }(), $ = function(t) {
        return !1 !== C && ("" === C ? t : C + t.charAt(0).toUpperCase() + t.substr(1))
    }("transform"), b = !1 !== $, y = function() {
        var t, e, i;
        return (e = (t = n.createElement("div")).style).position = "absolute", e.width = "100px", e.height = "100px", e.overflow = v, e.top = "-9999px", n.body.appendChild(t), i = t.offsetWidth - t.clientWidth, n.body.removeChild(t), i
    }, w = function() {
        var t, e, i;
        return e = o.navigator.userAgent, !!(t = /(?=.+Mac OS X)(?=.+Firefox)/.test(e)) && (i = (i = /Firefox\/\d{2}\./.exec(e)) && i[0].replace(/\D+/g, ""), t && 23 < +i)
    }, H.prototype.preventScrolling = function(t, e) {
        if (this.isActive)
            if (t.type === i)(e === h && 0 < t.originalEvent.detail || e === S && t.originalEvent.detail < 0) && t.preventDefault();
            else if (t.type === l) {
            if (!t.originalEvent || !t.originalEvent.wheelDelta) return;
            (e === h && t.originalEvent.wheelDelta < 0 || e === S && 0 < t.originalEvent.wheelDelta) && t.preventDefault()
        }
    }, H.prototype.nativeScrolling = function() {
        this.$content.css({
            WebkitOverflowScrolling: "touch"
        }), this.iOSNativeScrolling = !0, this.isActive = !0
    }, H.prototype.updateScrollValues = function() {
        var t;
        t = this.content, this.maxScrollTop = t.scrollHeight - t.clientHeight, this.prevScrollTop = this.contentScrollTop || 0, this.contentScrollTop = t.scrollTop, this.iOSNativeScrolling || (this.maxSliderTop = this.paneHeight - this.sliderHeight, this.sliderTop = 0 === this.maxScrollTop ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop)
    }, H.prototype.setOnScrollStyles = function() {
        var t, e;
        b ? (t = {})[$] = "translate(0, " + this.sliderTop + "px)" : t = {
            top: this.sliderTop
        }, T ? this.scrollRAF || (this.scrollRAF = T((e = this, function() {
            e.scrollRAF = null, e.slider.css(t)
        }))) : this.slider.css(t)
    }, H.prototype.createEvents = function() {
        var i, e, s, o, n, l, r;
        this.events = {
            down: function(t) {
                return r.isBeingDragged = !0, r.offsetY = t.pageY - r.slider.offset().top, r.pane.addClass("active"), r.doc.bind(d, r.events[a]).bind(g, r.events.up), !1
            },
            drag: function(t) {
                return l.sliderY = t.pageY - l.$el.offset().top - l.offsetY, l.scroll(), l.contentScrollTop >= l.maxScrollTop && l.prevScrollTop !== l.maxScrollTop ? l.$el.trigger("scrollend") : 0 === l.contentScrollTop && 0 !== l.prevScrollTop && l.$el.trigger("scrolltop"), !1
            },
            up: function(t) {
                return n.isBeingDragged = !1, n.pane.removeClass("active"), n.doc.unbind(d, n.events[a]).unbind(g, n.events.up), !1
            },
            resize: function(t) {
                o.reset()
            },
            panedown: function(t) {
                return s.sliderY = (t.offsetY || t.originalEvent.layerY) - .5 * s.sliderHeight, s.scroll(), s.events.down(t), !1
            },
            scroll: function(t) {
                e.updateScrollValues(), e.isBeingDragged || (e.iOSNativeScrolling || (e.sliderY = e.sliderTop, e.setOnScrollStyles()), null != t && (e.contentScrollTop >= e.maxScrollTop ? (e.options.preventPageScrolling && e.preventScrolling(t, h), e.prevScrollTop !== e.maxScrollTop && e.$el.trigger("scrollend")) : 0 === e.contentScrollTop && (e.options.preventPageScrolling && e.preventScrolling(t, S), 0 !== e.prevScrollTop && e.$el.trigger("scrolltop"))))
            },
            wheel: (i = e = s = o = n = l = r = this, function(t) {
                var e;
                if (null != t) return (e = t.delta || t.wheelDelta || t.originalEvent && t.originalEvent.wheelDelta || -t.detail || t.originalEvent && -t.originalEvent.detail) && (i.sliderY += -e / 3), i.scroll(), !1
            })
        }
    }, H.prototype.addEvents = function() {
        var t;
        this.removeEvents(), t = this.events, this.options.disableResize || this.win.bind(u, t[u]), this.iOSNativeScrolling || (this.slider.bind(e, t[h]), this.pane.bind(e, t.panedown).bind(l + " " + i, t.wheel)), this.$content.bind(v + " " + l + " " + i + " " + f, t[v])
    }, H.prototype.removeEvents = function() {
        var t;
        t = this.events, this.win.unbind(u, t[u]), this.iOSNativeScrolling || (this.slider.unbind(), this.pane.unbind()), this.$content.unbind(v + " " + l + " " + i + " " + f, t[v])
    }, H.prototype.generate = function() {
        var t, e, i, s;
        return i = (e = this.options).paneClass, s = e.sliderClass, e.contentClass, this.$el.find("." + i).length || this.$el.find("." + s).length || this.$el.append(''), this.pane = this.$el.children("." + i), this.slider = this.pane.find("." + s), 0 === p && w() ? t = {
            right: -14,
            paddingRight: +o.getComputedStyle(this.content, null).getPropertyValue("padding-right").replace(/\D+/g, "") + 14
        } : p && (t = {
            right: -p
        }, this.$el.addClass("has-scrollbar")), null != t && this.$content.css(t), this
    }, H.prototype.restore = function() {
        this.stopped = !1, this.iOSNativeScrolling || this.pane.show(), this.addEvents()
    }, H.prototype.reset = function() {
        var t, e, i, s, o, n, l, r, h, a;
        if (!this.iOSNativeScrolling) return this.$el.find("." + this.options.paneClass).length || this.generate().stop(), this.stopped && this.restore(), o = (s = (t = this.content).style).overflowY, c && this.$content.css({
            height: this.$content.height()
        }), e = t.scrollHeight + p, 0 < (r = parseInt(this.$el.css("max-height"), 10)) && (this.$el.height(""), this.$el.height(t.scrollHeight > r ? r : t.scrollHeight)), l = (n = this.pane.outerHeight(!1)) + parseInt(this.pane.css("top"), 10) + parseInt(this.pane.css("bottom"), 10), (a = Math.round(l / e * l)) < this.options.sliderMinHeight ? a = this.options.sliderMinHeight : null != this.options.sliderMaxHeight && a > this.options.sliderMaxHeight && (a = this.options.sliderMaxHeight), o === v && s.overflowX !== v && (a += p), this.maxSliderTop = l - a, this.contentHeight = e, this.paneHeight = n, this.paneOuterHeight = l, this.sliderHeight = a, this.slider.height(a), this.events.scroll(), this.pane.show(), this.isActive = !0, t.scrollHeight === t.clientHeight || this.pane.outerHeight(!0) >= t.scrollHeight && o !== v ? (this.pane.hide(), this.isActive = !1) : this.el.clientHeight === t.scrollHeight && o === v ? this.slider.hide() : this.slider.show(), this.pane.css({
            opacity: this.options.alwaysVisible ? 1 : "",
            visibility: this.options.alwaysVisible ? "visible" : ""
        }), "static" !== (i = this.$content.css("position")) && "relative" !== i || (h = parseInt(this.$content.css("right"), 10)) && this.$content.css({
            right: "",
            marginRight: h
        }), this;
        this.contentHeight = this.content.scrollHeight
    }, H.prototype.scroll = function() {
        if (this.isActive) return this.sliderY = Math.max(0, this.sliderY), this.sliderY = Math.min(this.maxSliderTop, this.sliderY), this.$content.scrollTop((this.paneHeight - this.contentHeight + p) * this.sliderY / this.maxSliderTop * -1), this.iOSNativeScrolling || (this.updateScrollValues(), this.setOnScrollStyles()), this
    }, H.prototype.scrollBottom = function(t) {
        if (this.isActive) return this.$content.scrollTop(this.contentHeight - this.$content.height() - t).trigger(l), this.stop().restore(), this
    }, H.prototype.scrollTop = function(t) {
        if (this.isActive) return this.$content.scrollTop(+t).trigger(l), this.stop().restore(), this
    }, H.prototype.scrollTo = function(t) {
        if (this.isActive) return this.scrollTop(this.$el.find(t).get(0).offsetTop), this
    }, H.prototype.stop = function() {
        return t && this.scrollRAF && (t(this.scrollRAF), this.scrollRAF = null), this.stopped = !0, this.removeEvents(), this.iOSNativeScrolling || this.pane.hide(), this
    }, H.prototype.destroy = function() {
        return this.stopped || this.stop(), !this.iOSNativeScrolling && this.pane.length && this.pane.remove(), c && this.$content.height(""), this.$content.removeAttr("tabindex"), this.$el.hasClass("has-scrollbar") && (this.$el.removeClass("has-scrollbar"), this.$content.css({
            right: ""
        })), this
    }, H.prototype.flash = function() {
        var t;
        if (!this.iOSNativeScrolling && this.isActive) return this.reset(), this.pane.addClass("flashed"), setTimeout(function() {
            t.pane.removeClass("flashed")
        }, (t = this).options.flashDelay), this
    }, r = H, s.fn.nanoScroller = function(i) {
        return this.each(function() {
            var t, e;
            if ((e = this.nanoscroller) || (t = s.extend({}, m, i), this.nanoscroller = e = new r(this, t)), i && "object" == typeof i) {
                if (s.extend(e.options, i), null != i.scrollBottom) return e.scrollBottom(i.scrollBottom);
                if (null != i.scrollTop) return e.scrollTop(i.scrollTop);
                if (i.scrollTo) return e.scrollTo(i.scrollTo);
                if ("bottom" === i.scroll) return e.scrollBottom(0);
                if ("top" === i.scroll) return e.scrollTop(0);
                if (i.scroll && i.scroll instanceof s) return e.scrollTo(i.scroll);
                if (i.stop) return e.stop();
                if (i.destroy) return e.destroy();
                if (i.flash) return e.flash()
            }
            return e.reset()
        })
    }, s.fn.nanoScroller.Constructor = r
}(jQuery, window, document);