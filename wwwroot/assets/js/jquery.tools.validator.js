/**
 * @license 
 * jQuery Tools Validator @VERSION - HTML5 is here. Now use it.
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/form/validator/
 * 
 * Since: Mar 2010
 * Date: @DATE 
 */
/*jslint evil: true */
/* http://jscompress.com/ */ 
(function (a) {
    function l(b, c, e) {
        function l(b, c, d) {
            if (!e.grouped && b.length) {
                return
            }
            var f;
            if (d === false || a.isArray(d)) {
                f = g.messages[c.key || c] || g.messages["*"];
                f = f[e.lang] || g.messages["*"].en;
                var h = f.match(/\$\d/g);
                if (h && a.isArray(d)) {
                    a.each(h, function (a) {
                        f = f.replace(this, d[a])
                    })
                }
            } else {
                f = d[e.lang] || d
            }
            b.push(f)
        }
        var f = this,
            i = c.add(f);
        b = b.not(":button, :image, :reset, :submit");
        c.attr("novalidate", "novalidate");
        a.extend(f, {
            getConf: function () {
                return e
            },
            getForm: function () {
                return c
            },
            getInputs: function () {
                return b
            },
            reflow: function () {
                b.each(function () {
                    var b = a(this),
                        c = b.data("msg.el");
                    if (c) {
                        var d = h(b, c, e);
                        c.css({
                            top: d.top,
                            left: d.left
                        })
                    }
                });
                return f
            },
            invalidate: function (c, d) {
                if (!d) {
                    var g = [];
                    a.each(c, function (a, c) {
                        var d = b.filter("[name='" + a + "']");
                        if (d.length) {
                            d.trigger("OI", [c]);
                            g.push({
                                input: d,
                                messages: [c]
                            })
                        }
                    });
                    c = g;
                    d = a.Event()
                }
                d.type = "onFail";
                i.trigger(d, [c]);
                if (!d.isDefaultPrevented()) {
                    k[e.effect][0].call(f, c, d)
                }
                return f
            },
            reset: function (c) {
                c = c || b;
                c.removeClass(e.errorClass).each(function () {
                    var b = a(this).data("msg.el");
                    if (b) {
                        b.remove();
                        a(this).data("msg.el", null)
                    }
                }).unbind(e.errorInputEvent + ".v" || "");
                return f
            },
            destroy: function () {
                c.unbind(e.formEvent + ".V").unbind("reset.V");
                b.unbind(e.inputEvent + ".V").unbind("change.V");
                return f.reset()
            },
            checkValidity: function (c, g) {
                c = c || b;
                c = c.not(":disabled");
                var h = {};
                c = c.filter(function () {
                    var b = a(this).attr("name");
                    if (!h[b]) {
                        h[b] = true;
                        return a(this)
                    }
                });
                if (!c.length) {
                    return true
                }
                g = g || a.Event();
                g.type = "onBeforeValidate";
                i.trigger(g, [c]);
                if (g.isDefaultPrevented()) {
                    return g.result
                }
                var m = [];
                c.each(function () {
                    var b = [],
                        c = a(this).data("messages", b),
                        h = d && c.is(":date") ? "onHide.v" : e.errorInputEvent + ".v";
                    c.unbind(h);
                    a.each(j, function () {
                        var a = this,
                            d = a[0];
                        if (c.filter(d).length) {
                            var h = a[1].call(f, c, c.val());
                            if (h !== true) {
                                g.type = "onBeforeFail";
                                i.trigger(g, [c, d]);
                                if (g.isDefaultPrevented()) {
                                    return false
                                }
                                var j = c.attr(e.messageAttr);
                                if (j) {
                                    b = [j];
                                    return false
                                } else {
                                    l(b, d, h)
                                }
                            }
                        }
                    });
                    if (b.length) {
                        m.push({
                            input: c,
                            messages: b
                        });
                        c.trigger("OI", [b]);
                        if (e.errorInputEvent) {
                            c.bind(h, function (a) {
                                f.checkValidity(c, a)
                            })
                        }
                    }
                    if (e.singleError && m.length) {
                        return false
                    }
                });
                var n = k[e.effect];
                if (!n) {
                    throw 'Validator: cannot find effect "' + e.effect + '"'
                }
                if (m.length) {
                    f.invalidate(m, g);
                    return false
                } else {
                    /*n[1].call(f, c, g);*/
                    g.type = "onSuccess";
                    i.trigger(g, [c]);
                    c.unbind(e.errorInputEvent + ".v")
                }
                return true
            }
        });
        a.each("onBeforeValidate,onBeforeFail,onFail,onSuccess".split(","), function (b, c) {
            if (a.isFunction(e[c])) {
                a(f).bind(c, e[c])
            }
            f[c] = function (b) {
                if (b) {
                    a(f).bind(c, b)
                }
                return f
            }
        });
        if (e.formEvent) {
            c.bind(e.formEvent + ".V", function (a) {
                if (!f.checkValidity(null, a)) {
                    return a.preventDefault()
                }
                a.target = c;
                a.type = e.formEvent
            })
        }
        c.bind("reset.V", function () {
            f.reset()
        });
        if (b[0] && b[0].validity) {
            b.each(function () {
                this.oninvalid = function () {
                    return false
                }
            })
        }
        if (c[0]) {
            c[0].checkValidity = f.checkValidity
        }
        if (e.inputEvent) {
            b.bind(e.inputEvent + ".V", function (b) {
                f.checkValidity(a(this), b)
            })
        }
        b.filter(":checkbox, select").filter("[required]").bind("change.V", function (b) {
	        var c = a(this);
            if (this.checked || c.is("select") && a(this).val()) {
                /*k[e.effect][1].call(f, c, b)*/
            }
        });
        b.filter(":radio[required]").bind("change.V", function (b) {
            var c = a("[name='" + a(b.srcElement).attr("name") + "']");
            if (c != null && c.length != 0) {
                f.checkValidity(c, b)
            }
        });
        a(window).resize(function () {
            f.reflow()
        })
    }
    function i(a) {
        function b() {
            return this.getAttribute("type") == a
        }
        b.key = "[type=" + a + "]";
        return b
    }
    function h(b, c, d) {
        c = a(c).first() || c;
        var e = b.offset().top,
            f = b.offset().left,
            g = d.position.split(/,?\s+/),
            h = g[0],
            i = g[1];
        e -= c.outerHeight() - d.offset[0];
        f += b.outerWidth() + d.offset[1];
        if (/iPad/i.test(navigator.userAgent)) {
            e -= a(window).scrollTop()
        }
        var j = c.outerHeight() + b.outerHeight();
        if (h == "center") {
            e += j / 2
        }
        if (h == "bottom") {
            e += j
        }
        var k = b.outerWidth();
        if (i == "center") {
            f -= (k + c.outerWidth()) / 2
        }
        if (i == "left") {
            f -= k
        }
        return {
            top: e,
            left: f
        }
    }
    a.tools = a.tools || {
        version: "@VERSION"
    };
    var b = /\[type=([a-z]+)\]/,
        c = /^-?[0-9]*(\.[0-9]+)?$/,
        d = a.tools.dateinput,
        e = /^([a-z0-9_\.\-\+]+)@([\da-z\.\-]+)\.([a-z\.]{2,6})$/i,
        f = /^(https?:\/\/)?[\da-z\.\-]+\.[a-z\.]{2,6}[#&+_\?\/\w \.\-=]*$/i,
        g;
    g = a.tools.validator = {
        conf: {
            grouped: false,
            effect: "default",
            errorClass: "invalid",
            inputEvent: null,
            errorInputEvent: "keyup",
            formEvent: "submit",
            lang: "en",
            message: "<div/>",
            messageAttr: "data-message",
            messageClass: "error",
            offset: [0, 0],
            position: "center right",
            singleError: false,
            speed: "normal"
        },
        messages: {
            "*": {
                en: "Please correct this value"
            }
        },
        localize: function (b, c) {
            a.each(c, function (a, c) {
                g.messages[a] = g.messages[a] || {};
                g.messages[a][b] = c
            })
        },
        localizeFn: function (b, c) {
            g.messages[b] = g.messages[b] || {};
            a.extend(g.messages[b], c)
        },
        fn: function (c, d, e) {
            if (a.isFunction(d)) {
                e = d
            } else {
                if (typeof d == "string") {
                    d = {
                        en: d
                    }
                }
                this.messages[c.key || c] = d
            }
            var f = b.exec(c);
            if (f) {
                c = i(f[1])
            }
            j.push([c, e])
        },
        addEffect: function (a, b, c) {
            k[a] = [b, c]
        }
    };
    var j = [],
        k = {
            "default": [function (b) {
                var c = this.getConf();
                a.each(b, function (b, d) {
                    var e = d.input;
                    e.addClass(c.errorClass);
                    var f = e.data("msg.el");
                    if (!f) {
                        f = a(c.message).addClass(c.messageClass).appendTo(document.body);
                        e.data("msg.el", f)
                    }
                    f.css({
                        visibility: "hidden"
                    }).find("p").remove();
                    a.each(d.messages, function (b, c) {
                        a("<p/>").html(c).appendTo(f)
                    });
                    if (f.outerWidth() == f.parent().width()) {
                        f.add(f.find("p")).css({
                            display: "inline"
                        })
                    }
                    var g = h(e, f, c);
                    f.css({
                        visibility: "visible",
                        position: "absolute",
                        top: g.top,
                        left: g.left
                    }).fadeIn(c.speed)
                })
            }, function (b) {
                var c = this.getConf();
                b.removeClass(c.errorClass).each(function () {
                    var b = a(this).data("msg.el");
                    if (b) {
                        b.css({
                            visibility: "hidden"
                        })
                    }
                })
            }]
        };
    a.each("email,url,number".split(","), function (b, c) {
        a.expr[":"][c] = function (a) {
            return a.getAttribute("type") === c
        }
    });
    a.fn.oninvalid = function (a) {
        return this[a ? "bind" : "trigger"]("OI", a)
    };
    g.fn(":email", "Please enter a valid email address", function (a, b) {
        return !b || e.test(b)
    });
    g.fn(":url", "Please enter a valid URL", function (a, b) {
        return !b || f.test(b)
    });
    g.fn(":number", "Please enter a numeric value.", function (a, b) {
        return c.test(b)
    });
    g.fn("[max]", "Please enter a value no larger than $1", function (a, b) {
        if (b === "" || d && a.is(":date")) {
            return true
        }
        var c = a.attr("max");
        return parseFloat(b) <= parseFloat(c) ? true : [c]
    });
    g.fn("[min]", "Please enter a value of at least $1", function (a, b) {
        if (b === "" || d && a.is(":date")) {
            return true
        }
        var c = a.attr("min");
        return parseFloat(b) >= parseFloat(c) ? true : [c]
    });
    g.fn("[required]", "Please complete this mandatory field.", function (a, b) {
        if (a.is(":checkbox")) {
            return a.is(":checked")
        }
        return !!b
    });
    g.fn("[pattern]", function (a, b) {
        return b === "" || (new RegExp("^" + a.attr("pattern") + "$")).test(b)
    });
    g.fn(":radio", "Please select an option.", function (b) {
        var c = false;
        var d = a("[name='" + b.attr("name") + "']").each(function (b, d) {
            if (a(d).is(":checked")) {
                c = true
            }
        });
        return c ? true : false
    });
    a.fn.validator = function (b) {
        var c = this.data("validator");
        if (c) {
            c.destroy();
            this.removeData("validator")
        }
        b = a.extend(true, {}, g.conf, b);
        if (this.is("form")) {
            return this.each(function () {
                var d = a(this);
                c = new l(d.find(":input"), d, b);
                d.data("validator", c)
            })
        } else {
            c = new l(this, this.eq(0).closest("form"), b);
            return this.data("validator", c)
        }
    }
})(jQuery);