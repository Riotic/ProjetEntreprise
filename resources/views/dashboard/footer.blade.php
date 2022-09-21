<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Synthèse Bilan de compétences</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="https://Synthèse Bilan de compétences.com/">Synthèse Bilan de compétences</a>
    </div>
</footer>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    function init_image() {
        imgs = document.images;
        for (i = 0; i < imgs.length; i++) {
            contain_candidat = imgs[i].src.includes('TuC_profil_pictures')
            if (contain_candidat == true) {
                imgs[i].alt += imgs[i].src;
            }
        }
    }
    setTimeout(init_image(), 1000);
</script>


<style>
    #sig-canvas {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
    }
</style>
@if (session('sign'))
<script>
    swal("Félicitations !", "", "success");
</script>
@endif
@if (session('Echec'))
<script>
    swal("Une erreur !", "", "error");
</script>
@endif

@if (Auth::user())
    @if (Auth::user()->role == 'tuc' || Auth::user()->role == 'tut' || Auth::user()->role == 'tue')
    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="https://i.ibb.co/bX1rRbZ/sign.png" alt="egbw" border="0" width="70px">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- Content -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-title">Veuillez imposer votre Signature</h3>
                                    <p>Attention vous ne pourrez le faire qu'une fois !</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <canvas id="sig-canvas" width="620" height="160">
                                        Get a better browser, bro.
                                    </canvas>
                                </div>
                            </div>
                            <br/>

                            <form action="{{ route('valid_sign') }}" method="POST" enctype="multipart/form-data">
                                {{ method_field('POST') }}
				@csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea hidden name="sig_data_url" id="sig-dataUrl" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" disabled class="btn btn-primary" id="sig-submitBtn">Valider cette Signature</button>
                                        <button type="reset" class="btn btn-warning" id="sig-clearBtn">Effacer la Signature</button>
                                    </div>
                                </div>
                                <br/>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <img id="sig-image" src="" alt="Your signature will go here!" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            let user = getCookie("sign");
            if (user != "") {
                return null
            } else {
                signdownloadSynthese();
            }
        }
        window.onload = function() {
            checkCookie()
        };

        function signdownloadSynthese() {
            swal("Nous vous invitons à émarger ", "Vous pouvez le faire en cliquant sur Ok", "success").then(function(isConfirm) {
                if (isConfirm) {
                    $("#largeModal").modal('show');
                } else {
                    swal("Vous devez émarger pour valider la synthèse", "N'hésitez pas à nous écrire sur votre messagerie !", "error");
                }
            });
        }
    </script>
    <script>
        var sigcanvas = document.getElementById("sig-canvas");
        sigcanvas.addEventListener("click", function() {
            document.getElementById('sig-submitBtn').disabled = false;
        });
        sigcanvas.addEventListener('touchstart', function(e) {
            document.getElementById('sig-submitBtn').disabled = false;
        });
    </script>
    <script>
        (function() {
            window.requestAnimFrame = (function(callback) {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function(callback) {
                        window.setTimeout(callback, 1000 / 60);
                    };
            })();

            var canvas = document.getElementById("sig-canvas");
            var ctx = canvas.getContext("2d");
            ctx.strokeStyle = "#222222";
            ctx.lineWidth = 4;

            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;

            canvas.addEventListener("mousedown", function(e) {
                drawing = true;
                lastPos = getMousePos(canvas, e);
            }, false);

            canvas.addEventListener("mouseup", function(e) {
                drawing = false;
            }, false);

            canvas.addEventListener("mousemove", function(e) {
                mousePos = getMousePos(canvas, e);
            }, false);

            // Add touch event support for mobile
            canvas.addEventListener("touchstart", function(e) {

            }, false);

            canvas.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var me = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                var touch = e.touches[0];
                var me = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchend", function(e) {
                var me = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(me);
            }, false);

            function getMousePos(canvasDom, mouseEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: mouseEvent.clientX - rect.left,
                    y: mouseEvent.clientY - rect.top
                }
            }

            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                }
            }

            function renderCanvas() {
                if (drawing) {
                    ctx.moveTo(lastPos.x, lastPos.y);
                    ctx.lineTo(mousePos.x, mousePos.y);
                    ctx.stroke();
                    lastPos = mousePos;
                }
            }

            // Prevent scrolling when touching the canvas
            document.body.addEventListener("touchstart", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchend", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchmove", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);

            (function drawLoop() {
                requestAnimFrame(drawLoop);
                renderCanvas();
            })();

            function clearCanvas() {
                canvas.width = canvas.width;
            }

            // Set up the UI
            var sigText = document.getElementById("sig-dataUrl");
            var sigImage = document.getElementById("sig-image");
            var clearBtn = document.getElementById("sig-clearBtn");
            var submitBtn = document.getElementById("sig-submitBtn");
            clearBtn.addEventListener("click", function(e) {
                clearCanvas();
                sigText.innerHTML = "Data URL for your signature will go here!";
                sigImage.setAttribute("src", "");
            }, false);
            submitBtn.addEventListener("click", function(e) {
                var dataUrl = canvas.toDataURL();
                sigText.innerHTML = dataUrl;
                sigImage.setAttribute("src", dataUrl);
                /*cookuie*/
                user = "true";
                if (user != "" && user != null) {
                    setCookie("sign", user, 3);
                }
            }, false);

        })();
    </script>
    @endif
@endif










<script>
    /* eslint-disable no-undef */
/**
 * autocomplete on map
 * https://github.com/tomik23/autocomplete
 *
 */

// config map
let config = {
  minZoom: 7,
  maxZoom: 18,
};
// magnification with which the map will start
const zoom = 18;
// co-ordinates
const lat = 52.22977;
const lng = 21.01178;

// calling map
const map = L.map("map", config).setView([lat, lng], zoom);

// Used to load and display tile layers on the map
// Most tile servers require attribution, which you can set under `Layer`
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// --------------------------------------------------------------
// create seearch button

// add "random" button
const buttonTemplate = `<div class="leaflet-search"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M31.008 27.231l-7.58-6.447c-0.784-0.705-1.622-1.029-2.299-0.998 1.789-2.096 2.87-4.815 2.87-7.787 0-6.627-5.373-12-12-12s-12 5.373-12 12 5.373 12 12 12c2.972 0 5.691-1.081 7.787-2.87-0.031 0.677 0.293 1.515 0.998 2.299l6.447 7.58c1.104 1.226 2.907 1.33 4.007 0.23s0.997-2.903-0.23-4.007zM12 20c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z"></path></svg></div><div class="auto-search-wrapper max-height"><input type="text" id="marker" autocomplete="off"  aria-describedby="instruction" aria-label="Search ..." /><div id="instruction" class="hidden">When autocomplete results are available use up and down arrows to review and enter to select. Touch device users, explore by touch or with swipe gestures.</div></div>`;

// create custom button
const customControl = L.Control.extend({
  // button position
  options: {
    position: "topleft",
    className: "leaflet-autocomplete",
  },

  // method
  onAdd: function () {
    return this._initialLayout();
  },

  _initialLayout: function () {
    // create button
    const container = L.DomUtil.create(
      "div",
      "leaflet-bar " + this.options.className
    );

    L.DomEvent.disableClickPropagation(container);

    container.innerHTML = buttonTemplate;

    return container;
  },
});

// adding new button to map controll
map.addControl(new customControl());

// --------------------------------------------------------------

// input element
const root = document.getElementById("marker");

function addClassToParent() {
  const searchBtn = document.querySelector(".leaflet-search");
  searchBtn.addEventListener("click", (e) => {
    // toggle class
    e.target
      .closest(".leaflet-autocomplete")
      .classList.toggle("active-autocomplete");

    // add placeholder
    root.placeholder = "Search ...";

    // focus on input
    root.focus();

    // click on clear button
    clickOnClearButton();
  });
}

// function click on clear button
function clickOnClearButton() {
  document.querySelector(".auto-clear").click();
}

addClassToParent();

// function clear input
map.on("click", () => {
  document
    .querySelector(".leaflet-autocomplete")
    .classList.remove("active-autocomplete");

  clickOnClearButton();
});

// autocomplete section
// more config find in https://github.com/tomik23/autocomplete
// --------------------------------------------------------------

new Autocomplete("marker", {
  delay: 1000,
  selectFirst: true,
  howManyCharacters: 2,

  onSearch: function ({ currentValue }) {
    const api = `https://nominatim.openstreetmap.org/search?format=geojson&limit=5&q=${encodeURI(
      currentValue
    )}`;

    /**
     * Promise
     */
    return new Promise((resolve) => {
      fetch(api)
        .then((response) => response.json())
        .then((data) => {
          resolve(data.features);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  },

  onResults: ({ currentValue, matches, template }) => {
    const regex = new RegExp(currentValue, "i");
    // checking if we have results if we don't
    // take data from the noResults method
    return matches === 0
      ? template
      : matches
          .map((element) => {
            return `
              <li role="option">
                <p>${element.properties.display_name.replace(
                  regex,
                  (str) => `<b>${str}</b>`
                )}</p>
              </li> `;
          })
          .join("");
  },

  onSubmit: ({ object }) => {
    const { display_name } = object.properties;
    const cord = object.geometry.coordinates;
    // custom id for marker
    // const customId = Math.random();

    // remove last marker
    map.eachLayer(function (layer) {
      if (layer.options && layer.options.pane === "markerPane") {
        if (layer._icon.classList.contains("leaflet-marker-locate")) {
          map.removeLayer(layer);
        }
      }
    });

    // add marker
    const marker = L.marker([cord[1], cord[0]], {
      title: display_name,
    });

    // add marker to map
    marker.addTo(map).bindPopup(display_name);

    // set marker to coordinates
    map.setView([cord[1], cord[0]], 8);

    // add class to marker
    L.DomUtil.addClass(marker._icon, "leaflet-marker-locate");
  },

  // the method presents no results
  noResults: ({ currentValue, template }) =>
    template(`<li>No results found: "${currentValue}"</li>`),
});
</script>
