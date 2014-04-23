/**
 * Author: contact@alexis-collin.fr
 * Description des éléments d'interactivité de COORDINOSAURE
 * 
 */
(function () {
    var window   = this,
        document = window.document,
        $        = window.jQuery,
        Mustache = window.Mustache,
        console  = window.console,
        alert    = window.alert,
        data = {
            maxAmapienEmail: 3,
            amapiens: [
                {
                    id:          0,
                    name:      "",
                    surname:   "",
                    email1:   "",
                    address:  "",
                    phone:      "",
                    date_arr: "",
                    updated:    true,
                    more:     "",
                    contrats: [
                        {
                            type:      "",
                            paiements: [0]
                        }
                    ]
                }
            ],
            contratTypes: [
                {
                    name:           "",
                    distributions: 0,
                    begin:         "01012012",
                    end:           "01012012",
                    products: [
                        {
                            name:  "",
                            prix: 0
                        }
                    ]
                }
            ],
            plusButton: {
                title:  "Ajouter un nouveau",
                id:     "",
                texte:  "+"
            }
        },
        template = {
            chequeList:          "<li><input id='cheque-{{id}}' class='textfield before' type='text' size='6' value='{{value}}'/><label for='cheque-{{id}}' class='after'>&euro;</label></li>",
            button:              "<a title='{{title}}' class='button' id='{{id}}'>{{texte}}</a>",
            contratTableHeader:  "<thead><tr><th>Contrat</th><th>Produits</th><th>Distribution</th><th>Date de début</th><th>Date de fin</th></tr></thead>",
            contratTableLine:    "<tr><th>{{name}}</th><th>{{produits}}</th><th>{{distrib}}</th><th>{{beginning}}</th><th>{{end}}</th></tr>",
            contratTableLineAlt: "<tr class='altLine'><th>{{name}}</th><th>{{produits}}</th><th>{{distrib}}</th><th>{{beginning}}</th><th>{{end}}</th></tr>",
            amapienTableHeader:  "<thead><tr><th>Amapien</th><th>address</th><th>Téléphone</th><th>Date d'arrivée</th><th>À jour</th><th>Plus</th><th>Email</th><th>Email alt</th><th>Email alt</th></tr></thead>",
            amapienTableLine:    "<tr><td>{{surname}}, {{name}}</td><td>{{address}}</td><td>{{phone}}</td><td>{{arrived}}</td><td>{{updated}}</td><td>{{infos}}</td><td>{{email1}}</td><td>{{email2}}</td><td>{{email3}}</td></tr>",
            amapienTableLineAlt: "<tr class='altLine'><td>{{surname}} {{name}}</td><td>{{address}}</td><td>{{phone}}</td><td>{{begin}}</td><td>{{isUpdate}}</td><td>{{infos}}</td><td>{{email1}}</td><td>{{email2}}</td><td>{{email3}}</td></tr>"
            
        },
        /**
         * Objet de l'interactivité
         */
        ui = function () {
            // Nuages : initialisation.
            var initPos = function () {
                return $('body').outerWidth() + 'px 0px';
            };
            $('header').css('background-position', initPos);
            // Nuages : animation
            var t = window.setInterval(function () {
                var currPos = $('header').css('background-position').split(' '),
                    nextPos = '',
                    width   = $('header').outerWidth();
                    //console.log(currPos[0], Math.abs( parseInt(currPos[0], 10) ), parseInt(width, 10));
                if (parseInt(currPos[0], 10) < 0 && Math.abs(parseInt(currPos[0], 10)) === parseInt(width, 10)) {
                    nextPos = initPos();
                    console.log(currPos[0], nextPos, width, $('header').css('background-position'));
                } else {
                    nextPos = (parseInt(currPos[0], 10) - 1) + 'px' + ' 0px';
                }
                $('header').css('background-position', nextPos);
            }, 50);
            /**
             * contenus
             */
            this.content = {
                add: {
                    /**
                     * CONSTRUCT TABLE
                     * @return {Object} table : élément de DOM à insérer dans la page.
                     */
                    table: function (destination, datas, template) {
                        /*
                        var currentTemplate = {
                            header: '',
                            line: '',
                            lineAlt: ''
                        };
                        $.extend(currentTemplate, template);
                        console.log("ui.content.add.table() > BEGIN");
                        datas = datas || [];
                        var table = "",
                            contentTable = "";
                        if (datas.length > 0) {
                            var amapiensLength = datas.length;
                            for (var i = 0; i < amapiensLength; i++) {
                                if (i % 2 === 0) {
                                    contentTable += Mustache.render(currentTemplate.line, datas[i]);
                                } else {
                                    contentTable += Mustache.render(currentTemplate.lineAlt, datas[i]);
                                }
                            }
                            // on étend la liste des amapiens : $.extend(amapiens, datas);
                        }
                        table = "<table class='tablesorter' id='mainListe'>";
                        table += currentTemplate.header;
                        table += "<tbody>";
                        if (contentTable !== undefined && contentTable !== "") {
                            table += contentTable;
                        }
                        table += "</tbody>";
                        table += "</table>";
                        */
                       $.ajax({
                           url: "raptor.php?list=amapiens",
                           dataType: "html",
                           success: function (data) {
                              $(destination).append(data);
                              console.log("window.ui.content.add.table() > END");
                           }
                       });
                    },
                    /**
                     * AJOUTER DES CHEQUES : 
                     */
                    chequesDetails: function (ul, toAdd) {
                        // on ajoute un namebre de li dans ul
                        var lastLiID = $("#" + $(ul)[0].id + ":last-child").id,
                            content = {id: lastLiID, value: "00,00"};
                        for (var i = 0;i <= toAdd; i++) {
                            $(ul).append(Mustache.render(template.chequeList, content));
                        }
                    },
                    /**
                     * Create Email Input
                     * @param {Object} after : élément de DOM après lequel insérer le bouton.
                     */
                    inputEmailButton: function (after, val) {
                        var button = $('<input class="emailValue textfield before" id="email-amapien' + val + '" type="text" value="email" />');
                        button.insertAfter(after);
                        var defaultValue = $("#email-amapien" + val).val();
                        $("#email-amapien" + val).data('default', defaultValue);
                        $("#email-amapien" + val).focusin(function () {
                            //console.info($(this).val(), defaultValue);
                            if ($(this).val() === defaultValue) {
                                $(this).val("");
                            }
                        });
                        $("#email-amapien" + val).focusout(function () {
                            //console.info($(this).val(), defaultValue);
                            if ($(this).val() === "") {
                                $(this).val(defaultValue);
                            }
                        });
                    },
                    button: {
                    /**
                         * Create Add Button
                         * @param {Object} after : élément de DOM après lequel insérer le bouton.
                         */
                        add: function (after) {
                            console.log(this);
                            var myButton = Mustache.render(
                                template.button,
                                $.extend(
                                    window.data.plusButton,
                                    {id: "addEmail-amapien", title: "ajouter une address"}
                                )
                            );
                            $(myButton).insertAfter(after);
                            $("#addEmail-amapien").click(function () {
                                window.ui.content.update.liste.emails();
                            });
                        },
                        /**
                         * Create Suppr Button
                         * @param {Object} after : élément de DOM après lequel insérer le bouton.
                         */
                        sup: function (after) {
                            var button = $('<a id="removeEmail-amapien" class="button" title="supprimer la dernière address">-</a>');
                            button.insertAfter(after);
                            $("#removeEmail-amapien").click(function () {
                                $(after).remove();
                                var emailInputs = $('.emailValue').length;
                                if (emailInputs <= 1) {
                                    $("#removeEmail-amapien").remove();
                                }
                                if ($("#addEmail-amapien").length < 1) {
                                    window.ui.content.add.button.add('#removeEmail-amapien');
                                }
                            });
                        }
                    }
                },
                remove: {
                    /**
                     * SUPPRIMER DES CHEQUES
                     */
                    chequesdetails: function (ul, toSuppr) {
                        // on supprime les x dernière de ul :
                        for (var i = 0;i <= toSuppr; i++) {
                            var currentLi = $("#" + $(ul)[0].id + ":last-child");
                            $(currentLi).remove();
                        }
                    }
                },
                update: {
                    liste: {
                        /**
                         * REFRESH LISTES DES CHEQUES
                         */
                        cheques: function (select, ul) {
                            var currentNum = parseInt($(select).val(), 10),
                                content = {id: currentNum, value: "02.00"},
                                currentLi = $("#" + $(ul)[0].id + " > li");
                            // on compare le namebre de li : si > on suppr, sinon on ajoute
                            if (currentLi.length > currentNum) {
                                console.log(currentLi.length);
                                window.ui.remove.chequesdetails(ul, parseInt(currentLi.length - currentNum, 10));
                            } else {
                                console.log(currentLi.length);
                                window.ui.content.add.chequesDetails(ul, parseInt(currentNum - currentLi.length, 10));
                            }
                            //$(ul).empty();
                            for (var i = 1; i <= currentNum; i++) {
                                // console.log(Mustache.render(template.chequeList, content));
                                $(ul).append(Mustache.render(template.chequeList, content));
                            }
                        },
                        contrat: function () {
                            var emailInputs = $('.emailValue').length;
                            $('.emailValue:last').after('<input class="emailValue" id="email' + parseInt(emailInputs, 10) + '" tabindex="3" type="text" value="email" />  ');
                            emailInputs++;
                            //console.info(emailInputs, $("#removeEmail").length);
                            if (emailInputs > 1 && $("#removeEmail").length < 1) {
                                $('.emailValue:last').after('<a id="removeEmail" title="supprimer la dernière address">-</a>');
                                $("#removeEmail").click(function () {
                                    $('.emailValue:last').remove();
                                    emailInputs = $('.emailValue').length;
                                    if (emailInputs <= 1) {
                                        $("#removeEmail").remove();
                                    }
                                    if ($("#addEmail").length < 1) {
                                        $('#removeEmail').after('<a id="addEmail" title="ajouter une address">+</a>');
                                        $("#addEmail").click(function () {
                                            window.ui.update.liste.emails();
                                        });
                                    }
                                });
                            }
                            if (emailInputs === window.data.maxAmapienEmail) {
                                $("#addEmail").remove();
                            }
                        },
                        /**
                         * Refresh Email List
                         */
                        emails: function () {
                            var emailInputs = $('.emailValue').length;
                            window.ui.content.add.inputEmailButton('.emailValue:last', parseInt(emailInputs, 10));
                            emailInputs++;
                            //console.info(emailInputs, $("#removeEmail-amapien").length);
                            if (emailInputs > 1 && $("#removeEmail-amapien").length < 1) {
                                window.ui.content.add.button.sup('.emailValue:last');
                            }
                            if (emailInputs === window.data.maxAmapienEmail) {
                                $("#addEmail-amapien").remove();
                            }
                        }
                    }
                }
            };
            this.tools = {
                /**
                 * DEFAULT VALUE FOR
                 * @param {Array} input Liste des inputs à gérer au focus
                 */
                defaultValueFor: function (input) {
                    var focusin = function (ev) {
                            if ($(ev.currentTarget).val() === $(ev.currentTarget).data("default")) {
                                $(ev.currentTarget).val("");
                            }
                        },
                        focusout = function (ev) {
                            if ($(ev.currentTarget).val() === "") {
                                $(ev.currentTarget).val($(ev.currentTarget).data("default"));
                            }
                        };
                    for (var i = 0; i < $(input).length; i++) {
                        $($(input)[i]).data("default", $($(input)[i]).val());
                    }
                    $(input).on('focusin', function (ev) {
                        focusin(ev);
                    }).on('focusout', function (ev) {
                        focusout(ev);
                    });
                }
            };
            /**
             * DEFINE BUTTONS
             */
            this.buttons = function () {
                $("#install-db").off().on('click', function (ev) {
                    ev.preventDefault();
                    $.ajax({
                        url: 'raptor.php?install',
                        success: function (data) {
                            alert(data);
                        }
                    });
                });
                $("#suppr-db").off().on('click', function (ev) {
                    ev.preventDefault();
                    $.ajax({
                        url: 'raptor.php?deleteAll',
                        success: function (data) {
                            alert(data);
                        }
                    });
                });
                $.datepicker.setDefaults($.datepicker.regional.fr);
                $("#begin-product").datepicker({dateFormat: "dd/mm/yy"});
                $("#end-product").datepicker({dateFormat: "dd/mm/yy"});
                $("#addEmail-amapien").click(function () {
                    window.ui.content.update.liste.emails();
                });
                $("#addContract-amapien").click(function () {
                    window.ui.content.update.contrats();
                });
                $('#contrat-01-chequesNum').change(function () {
                    window.ui.content.update.liste.cheques($(this), $("#contrat-01-chequesNum ~ ul"));
                });
                // AJOUTER UN NOUVEAU
                window.POPIN = "";
                $('.mainMenu a[data-toggle]').off().on('click', function (e) {
                    window.POPIN = $(this).attr('href');
                });
                $('#mainModal').on('show.bs.modal', function (e) {
                    $('#mainModal > .modal-dialog').load(window.POPIN);
                });
            };
            /**
             * GESTION DES FORMULAIRES
             */
            this.form = {
                /**
                 * CLICK SUR LE BOUTON SUBMIT
                 */
                submit: function (form, succeed) {
                    var data = {},
                        url  = $(".popin form").attr('action');
                    switch (form) {
                    case 'producteur':
                        data = {
                            name:    $('#name').val(),
                            surname: $('#surname').val(),
                            email1:  $('#email1').val(),
                            address: $('#address').val(),
                            zipcode: $('#zipcode').val(),
                            city:    $('#city').val(),
                            phone:   $('#phone').val(),
                            infos:   $('#infos').val()
                        };
                        break;
                    case 'amapien':
                        data = {
                            name:    $('#name').val(),
                            surname: $('#surname').val(),
                            email1:  $('#email1').val(),
                            email2:  $('#email2').val(),
                            email3:  $('#email3').val(),
                            address: $('#address').val(),
                            zipcode: $('#zipcode').val(),
                            city:    $('#city').val(),
                            phone:   $('#phone').val(),
                            arrived: $('#arrived').val(),
                            infos:   $('#infos').val(),
                            updated: ($('#updated').val() === 'on') ? 1 : 0,
                            active:  ($('#active').val()  === 'on') ? 1 : 0
                        };
                        break;
                    case 'contrat':
                        data = {
                            name:    $('#name').val(),
                            producteur_id: $('#producteur_id').val(),
                            debut:  $('#debut').val(),
                            fin:  $('#fin').val()
                        };
                        break;
                    case 'produit':
                        data = {
                            name:    $('#name').val(),
                            contrat_id: $('#contrat_id').val(),
                            prix_unitaire:  $('#prix_unitaire').val()
                        };
                        break;
                    }
                    $.ajax({
                        url: url,
                        data: {data: data},
                        dataType: 'JSON',
                        method: 'GET',
                        success: function (data) {
                            succeed(data);
                        },
                        error:   function (data) {
                            console.warn(data);
                        }
                    }
                    );
                },
                /**
                 * CLICK SUR FERMER
                 */
                close: function () {
                    $('.popin').fadeOut('fast', function () {
                        $('.popin-shadow').fadeOut('slow');
                    });
                    $(".popin").remove();
                },
                /**
                 * Mise en place du popin
                 */
                init: function () {
                    console.info("window.ui.form.init");
                    var win =  {
                        w: $(window).width(),
                        h: $(document).height()
                    };
                    $(window).bind('resize', function () {
                        var win = $(window).width();
                        $('.popin').css("left", Math.round((win - 960) / 2));
                    });
                    $('.popin .close').off().on('click', function () {
                        window.ui.form.close();
                    });
                    $('html').on('keyup', function (ev) {
                        if (ev.keyCode === 27) {
                            window.ui.form.close();
                        }
                    });
                    $(".popin input[type=submit]").off().on('click', function (ev) {
                        ev.preventDefault();
                        var action = $(ev.currentTarget).parents('form').attr('action'),
                            success = function (infos) {
                                if (infos === null) {
                                    return false;
                                } else {
                                    window.alert(infos.msg);
                                    window.ui.form.close();
                                }
                            };
                        window.ui.form.submit(window.ui.form.current.popin, window.ui.form.current.success);
                    });
                    $(".datepick").datepicker({dateFormat: "dd/mm/yy"});
                    $('.popin').css("left", Math.round((win.w - 960) / 2));
                    $('.popin-shadow').css("height", win.h);
                    $('.popin-shadow').fadeIn('fast', function () {
                        $('.popin').fadeIn('fast');
                    });
                },
                /**
                 * Définition des méthodes à appeler au retour de l'envoi du formulaire
                 */
                producteur: function () {
                    this.current = {
                        popin: 'producteur',
                        success: function (data) {
                            if (infos === null) {
                                return false;
                            } else {
                                window.alert(data.infos);
                                window.ui.form.close();
                            }
                        }
                    };
                    window.ui.form.init();
                },
                amapien: function () {
                    this.current = {
                        popin: 'amapien',
                        success: function (infos) {
                            if (infos === null) {
                                return false;
                            } else {
                                window.alert(infos.msg);
                                window.ui.form.close();
                            }
                        }
                    };
                    window.ui.form.init();
                },
                contrat: function () {
                    this.current = {
                        popin: 'contrat',
                        success: function (infos) {
                            if (infos === null) {
                                return false;
                            } else {
                                window.alert(infos.msg);
                                window.ui.form.close();
                            }
                        }
                    };
                    window.ui.form.init();
                },
                produit: function () {
                    this.current = {
                        popin: 'produit',
                        success: function (infos) {
                            if (infos === null) {
                                return false;
                            } else {
                                window.alert(infos.msg);
                                window.ui.form.close();
                            }
                        }
                    };
                    window.ui.form.init();
                }
            };
        };
    $(document).ready(function () {
        /mobi/i.test(navigator.userAgent) && !location.hash && setTimeout(function () {
          if (!pageYOffset) window.scrollTo(0, 1);
        }, 1000);
        // instanciation du gestionnaire d'interface 
        window.ui = new ui();
        
        // applique les contenus par défaut des champs de texte.
        window.ui.tools.defaultValueFor($(".textfield"));
        
        // construction des tableaux de données
        window.ui.page = $('body').attr('data-page');
        
        // Dynamisme des tableaux
        $("#mainListe").tablesorter([0, 0]);
        for (var i = 0; i < $(".cheques-num").length; i++) {
            window.ui.content.update.liste.cheques($(".cheques-num")[i], $(".cheques-list")[i]);
        }
        // Initialisation des boutons
        window.ui.buttons();
        console.info('INTERFACE CHARGÉE!');
    });
})();
