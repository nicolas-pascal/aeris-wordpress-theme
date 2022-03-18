(function() {
   tinymce.create('tinymce.plugins.listchild', {
      init : function(ed, url) {
         ed.addButton('listchild', {
            title : 'List child page',
            image : url+'/listchildbutton.png',
            onclick : function() {
               var arr = [];
                /**
                 * Permet de récupérer les pages existantes
                 * via l'API Rest de WordPress grâce à une requête Ajax 
                 */
                function getData() {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            response = JSON.parse(this.responseText);
                            
                            for (i = 0; i < response.length; i++) 
                            { 
                                var d = {};
                                d.text = response[i].id + ' : ' + HtmlEntities.decode(response[i].title.rendered);
                                d.value = response[i].id.toString();
                                arr.push(d);
                            }	

                            return arr;
                        }
                    };
                    xmlhttp.open("GET", '../wp-json/wp/v2/pages?per_page=20&&order=desc', true);
                    xmlhttp.send();
                } /** --- Fin Fonction getData */

                getData();

               // permet de configurer la fenêtre modale
                ed.windowManager.open( {
                    title: "Sélectionnez la liste à insérer",
                    width: 470,
                    height: 150,
                    body: [
                        {
                            type: 'listbox', // select
                            name: 'listboxName',
                            label: 'Pages existantes',	        
                            values: arr, // tableau d'objets contenant les données JSON des pages
                            text: 'Choix de la page parent'
                        },{
                            type: 'textbox', // select
                            name: 'posts_per_page',
                            label: 'Nbre de page',
                        },{
                            type: 'listbox', // select
                            name: 'order',
                            label: 'Ordre',	        
                            values: [ 
                                { text: 'ASC', value: 'ASC'},
                                { text: 'DESC', value: 'DESC'}
                            ]
                        },
                        
                    ],
                    onsubmit: function( e ) {
                        if (e.data.listboxName != null && e.data.listboxName != '') {
                            // Insertion automatisée d'un shortcode avec un attribut 
                            //id qui contient la valeur du select
                            ed.insertContent( '[aeris_childpage post_parent="' + e.data.listboxName + '" posts_per_page="' + e.data.posts_per_page + '" order="' + e.data.order + '"]');
                        }
                    }     				

                } );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "List child page",
            author : 'Pierre Vert',
            authorurl : 'https://www.sedoo.fr',
            infourl : '',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('listchild', tinymce.plugins.listchild);

    /**
	 * Gestion des caractères spéciaux
	 */
	var HtmlEntities = function() {};

	HtmlEntities.map = {
	    "'": "&apos;",
	    "<": "&lt;",
	    ">": "&gt;",
	    " ": "&nbsp;",
	    "¡": "&iexcl;",
	    "¢": "&cent;",
	    "£": "&pound;",
	    "¤": "&curren;",
	    "¥": "&yen;",
	    "¦": "&brvbar;",
	    "§": "&sect;",
	    "¨": "&uml;",
	    "©": "&copy;",
	    "ª": "&ordf;",
	    "«": "&laquo;",
	    "¬": "&not;",
	    "®": "&reg;",
	    "¯": "&macr;",
	    "°": "&deg;",
	    "±": "&plusmn;",
	    "²": "&sup2;",
	    "³": "&sup3;",
	    "´": "&acute;",
	    "µ": "&micro;",
	    "¶": "&para;",
	    "·": "&middot;",
	    "¸": "&cedil;",
	    "¹": "&sup1;",
	    "º": "&ordm;",
	    "»": "&raquo;",
	    "¼": "&frac14;",
	    "½": "&frac12;",
	    "¾": "&frac34;",
	    "¿": "&iquest;",
	    "À": "&Agrave;",
	    "Á": "&Aacute;",
	    "Â": "&Acirc;",
	    "Ã": "&Atilde;",
	    "Ä": "&Auml;",
	    "Å": "&Aring;",
	    "Æ": "&AElig;",
	    "Ç": "&Ccedil;",
	    "È": "&Egrave;",
	    "É": "&Eacute;",
	    "Ê": "&Ecirc;",
	    "Ë": "&Euml;",
	    "Ì": "&Igrave;",
	    "Í": "&Iacute;",
	    "Î": "&Icirc;",
	    "Ï": "&Iuml;",
	    "Ð": "&ETH;",
	    "Ñ": "&Ntilde;",
	    "Ò": "&Ograve;",
	    "Ó": "&Oacute;",
	    "Ô": "&Ocirc;",
	    "Õ": "&Otilde;",
	    "Ö": "&Ouml;",
	    "×": "&times;",
	    "Ø": "&Oslash;",
	    "Ù": "&Ugrave;",
	    "Ú": "&Uacute;",
	    "Û": "&Ucirc;",
	    "Ü": "&Uuml;",
	    "Ý": "&Yacute;",
	    "Þ": "&THORN;",
	    "ß": "&szlig;",
	    "à": "&agrave;",
	    "á": "&aacute;",
	    "â": "&acirc;",
	    "ã": "&atilde;",
	    "ä": "&auml;",
	    "å": "&aring;",
	    "æ": "&aelig;",
	    "ç": "&ccedil;",
	    "è": "&egrave;",
	    "é": "&eacute;",
	    "ê": "&ecirc;",
	    "ë": "&euml;",
	    "ì": "&igrave;",
	    "í": "&iacute;",
	    "î": "&icirc;",
	    "ï": "&iuml;",
	    "ð": "&eth;",
	    "ñ": "&ntilde;",
	    "ò": "&ograve;",
	    "ó": "&oacute;",
	    "ô": "&ocirc;",
	    "õ": "&otilde;",
	    "ö": "&ouml;",
	    "÷": "&divide;",
	    "ø": "&oslash;",
	    "ù": "&ugrave;",
	    "ú": "&uacute;",
	    "û": "&ucirc;",
	    "ü": "&uuml;",
	    "ý": "&yacute;",
	    "þ": "&thorn;",
	    "ÿ": "&yuml;",
	    "Œ": "&OElig;",
	    "œ": "&oelig;",
	    "Š": "&Scaron;",
	    "š": "&scaron;",
	    "Ÿ": "&Yuml;",
	    "ƒ": "&fnof;",
	    "ˆ": "&circ;",
	    "˜": "&tilde;",
	    "Α": "&Alpha;",
	    "Β": "&Beta;",
	    "Γ": "&Gamma;",
	    "Δ": "&Delta;",
	    "Ε": "&Epsilon;",
	    "Ζ": "&Zeta;",
	    "Η": "&Eta;",
	    "Θ": "&Theta;",
	    "Ι": "&Iota;",
	    "Κ": "&Kappa;",
	    "Λ": "&Lambda;",
	    "Μ": "&Mu;",
	    "Ν": "&Nu;",
	    "Ξ": "&Xi;",
	    "Ο": "&Omicron;",
	    "Π": "&Pi;",
	    "Ρ": "&Rho;",
	    "Σ": "&Sigma;",
	    "Τ": "&Tau;",
	    "Υ": "&Upsilon;",
	    "Φ": "&Phi;",
	    "Χ": "&Chi;",
	    "Ψ": "&Psi;",
	    "Ω": "&Omega;",
	    "α": "&alpha;",
	    "β": "&beta;",
	    "γ": "&gamma;",
	    "δ": "&delta;",
	    "ε": "&epsilon;",
	    "ζ": "&zeta;",
	    "η": "&eta;",
	    "θ": "&theta;",
	    "ι": "&iota;",
	    "κ": "&kappa;",
	    "λ": "&lambda;",
	    "μ": "&mu;",
	    "ν": "&nu;",
	    "ξ": "&xi;",
	    "ο": "&omicron;",
	    "π": "&pi;",
	    "ρ": "&rho;",
	    "ς": "&sigmaf;",
	    "σ": "&sigma;",
	    "τ": "&tau;",
	    "υ": "&upsilon;",
	    "φ": "&phi;",
	    "χ": "&chi;",
	    "ψ": "&psi;",
	    "ω": "&omega;",
	    "ϑ": "&thetasym;",
	    "ϒ": "&Upsih;",
	    "ϖ": "&piv;",
	    "–": "&ndash;",
	    "—": "&mdash;",
	    "‘": "&lsquo;",
	    "’": "&rsquo;",
	    "‚": "&sbquo;",
	    "“": "&ldquo;",
	    "”": "&rdquo;",
	    "„": "&bdquo;",
	    "†": "&dagger;",
	    "‡": "&Dagger;",
	    "•": "&bull;",
	    "…": "&hellip;",
	    "‰": "&permil;",
	    "′": "&prime;",
	    "″": "&Prime;",
	    "‹": "&lsaquo;",
	    "›": "&rsaquo;",
	    "‾": "&oline;",
	    "⁄": "&frasl;",
	    "€": "&euro;",
	    "ℑ": "&image;",
	    "℘": "&weierp;",
	    "ℜ": "&real;",
	    "™": "&trade;",
	    "ℵ": "&alefsym;",
	    "←": "&larr;",
	    "↑": "&uarr;",
	    "→": "&rarr;",
	    "↓": "&darr;",
	    "↔": "&harr;",
	    "↵": "&crarr;",
	    "⇐": "&lArr;",
	    "⇑": "&UArr;",
	    "⇒": "&rArr;",
	    "⇓": "&dArr;",
	    "⇔": "&hArr;",
	    "∀": "&forall;",
	    "∂": "&part;",
	    "∃": "&exist;",
	    "∅": "&empty;",
	    "∇": "&nabla;",
	    "∈": "&isin;",
	    "∉": "&notin;",
	    "∋": "&ni;",
	    "∏": "&prod;",
	    "∑": "&sum;",
	    "−": "&minus;",
	    "∗": "&lowast;",
	    "√": "&radic;",
	    "∝": "&prop;",
	    "∞": "&infin;",
	    "∠": "&ang;",
	    "∧": "&and;",
	    "∨": "&or;",
	    "∩": "&cap;",
	    "∪": "&cup;",
	    "∫": "&int;",
	    "∴": "&there4;",
	    "∼": "&sim;",
	    "≅": "&cong;",
	    "≈": "&asymp;",
	    "≠": "&ne;",
	    "≡": "&equiv;",
	    "≤": "&le;",
	    "≥": "&ge;",
	    "⊂": "&sub;",
	    "⊃": "&sup;",
	    "⊄": "&nsub;",
	    "⊆": "&sube;",
	    "⊇": "&supe;",
	    "⊕": "&oplus;",
	    "⊗": "&otimes;",
	    "⊥": "&perp;",
	    "⋅": "&sdot;",
	    "⌈": "&lceil;",
	    "⌉": "&rceil;",
	    "⌊": "&lfloor;",
	    "⌋": "&rfloor;",
	    "⟨": "&lang;",
	    "⟩": "&rang;",
	    "◊": "&loz;",
	    "♠": "&spades;",
	    "♣": "&clubs;",
	    "♥": "&hearts;",
	    "♦": "&diams;"
	};

	HtmlEntities.decode = function(string) {
	    var entityMap = HtmlEntities.map;
	    for (var key in entityMap) {
	        var entity = entityMap[key];
	        var regex = new RegExp(entity, 'g');
	        string = string.replace(regex, key);
	    }
	    string = string.replace(/&quot;/g, '"');
	    string = string.replace(/&amp;/g, '&');
	    return string;
	}


})();