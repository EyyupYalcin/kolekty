<?php
function hizmet_grid(){
    ?>
    <style>
        .testtest {
            height: min-content;
        }

        #serviceContainer {
            min-height: 170px;
        }
    </style>
    <div class="card card-custom gutter-b">
        <!--begin::Body-->
        <div class="card-body" style="position: relative;">

            <div class="mb-6">
                <a id="backBtn" style="position: absolute; left: 2.25rem; top: 2rem; display: none;" class="btn btn-light font-weight-bold mr-2">Geri</a>
                <span id="cardTitle" class="max-h-30px font-size-h2 text-dark text-center font-weight-bold">Servisler</span>
            </div>
            <hr>
            <ul id="serviceContainer" class="justify-content-center nav nav-pills nav-warning row row-paddingless m-0 p-0 flex-sm-row" style="" role="tablist">
            </ul>
            <!--begin::ServiceTemplate-->
            <template id="serviceTemplate">
                <li id="-[SERVICE_ID]-" class="nav-item d-flex testtest flex-shrink-0 m-3">
                    <a class="nav-link border min-w-300px py-10 d-flex rounded flex-column align-items-center" data-toggle="pill">
                        <span class="nav-icon py-2 w-auto">
                            <span class="svg-icon svg-icon-10x">
                                -[SVG]-
                            </span>
                        </span>
                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center" style="font-size: 1.5rem;">-[TITLE]-</span>
                    </a>
                </li>
            </template>
            <!--end::ServiceTemplate-->
        </div>
        <!--end::Body-->
    </div>

    <pre>
        <?php
            $hizmetler = get_Hizmetler_where(" gorunurluk != 0");
            $json_hizmetler = [];
            $hizmet_json['SERVICE_ID'] = "root";
            $hizmet_json['TITLE'] = "Kolekty";
            $json_hizmetler[] = $hizmet_json;
            // var_dump($hizmetler);
            foreach ($hizmetler as $hizmet) {
                global $hizmet_id;
                $hizmet_id = $hizmet['id'];
                $hizmet_json = [];
                $hizmet_json['SERVICE_ID'] = "SERVICE_".$hizmet['id'];
                $hizmet_json['TITLE'] = $hizmet['hizmet_adi'];
                $hizmet_json['PARENT_ID'] = $hizmet['ust_id'] == 0 ? "root" : "SERVICE_" . $hizmet['ust_id'];
                $hizmet_json['SVG'] = (!isset($hizmet['icon']) || $hizmet['icon'] == "") ? "assets/dashboard/media/svg/icons/Design/Magic.svg" : $hizmet['icon'];
                $alt_menuler = array_filter($hizmetler, function($v, $k) {
                    global $hizmet_id;
                    // echo $hizmet_id . "[hizmet_id]";
                    if($v['ust_id'] == $hizmet_id){
                        // echo $hizmet_id . " -> ";
                        // var_dump($v); 
                        // echo "<hr>";
                    }
                    return $v['ust_id'] == $hizmet_id;
                }, ARRAY_FILTER_USE_BOTH);

                if(count($alt_menuler) == 0){
                    $hizmet_json['FORM'] = "Hizmetler/" . $hizmet['hizmet_adi'] . "/card";
                }
                //var_dump(file_exists("sayfalar/Hizmetler/" . $hizmet['hizmet_adi'] . ".php"));
                $json_hizmetler[] = $hizmet_json;

                //$hizmet_json = json_encode($hizmet_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                //$hizmet_json;
                //var_dump(json_encode($hizmet, JSON_UNESCAPED_UNICODE));
            }
            //var_dump($json_hizmetler);
        ?>
    </pre>

    <script>
        var services = <?= json_encode($json_hizmetler, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>

        console.log(services);

        function getSVG(path) {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", path, false); // false for synchronous request
            xmlHttp.send(null);
            if (xmlHttp.status == 200) return xmlHttp.responseText;
            return path;
        }

        function getFORM(path) {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", path, false); // false for synchronous request
            xmlHttp.send(null);
            if (xmlHttp.status == 200) return xmlHttp.responseText;
            return path;
        }

        function findService(Service_ID) {
            return services.find(service => service.SERVICE_ID == Service_ID);
        }

        function findChildServices(Parent_ID) {
            return services.filter(service => service.PARENT_ID == Parent_ID);
        }

        function serviceElementFromTemplate(template_id, service) {
            var htmlString = document.getElementById(template_id).innerHTML;
            Object.keys(service).forEach(key => {
                if (key == "SVG") {
                    service[key] = getSVG(service[key]);
                }
                htmlString = htmlString.replace("-[" + key + "]-", service[key]);
            });
            var div = document.createElement('div');
            div.innerHTML = htmlString.trim();
            // Change this to div.childNodes to support multiple top-level nodes
            return div.firstChild;
        }

        function showServices(Service_ID) {
            var cardTitle = document.getElementById('cardTitle');
            cardTitle.innerText = findService(Service_ID).TITLE + " Servisleri";
            var backBtn = document.getElementById('backBtn');
            if (Service_ID == "root") {
                backBtn.style.display = "none";
            }
            console.log(Service_ID);
            var childens = findChildServices(Service_ID);
            console.log(childens);
            var serviceContainer = document.getElementById("serviceContainer");
            serviceContainer.innerHTML = "";
            childens.forEach(service => {
                serviceElement = serviceElementFromTemplate("serviceTemplate", service);
                serviceElement.dataset.parent_id = service.PARENT_ID;
                serviceElement.onclick = function (e) {
                    e.preventDefault();
                    backBtn.style.display = "inline-block";
                    backBtn.dataset.target = this.dataset.parent_id;
                    if (findService(this.id).FORM == null) {
                        showServices(this.id);
                    } else {
                        cardTitle.innerText = findService(this.id).TITLE + " Rezervasyon";
                        $("#serviceContainer").load(encodeURIComponent(findService(this.id).FORM));
                        //serviceContainer.innerHTML = getFORM(findService(this.id).FORM);

                    }
                    return false;
                }
                serviceContainer.appendChild(serviceElement);
            });
        }
        document.addEventListener("DOMContentLoaded", (event) => {
            event.preventDefault();
            showServices("root");
            document.getElementById('backBtn').onclick = function (e) {
                e.preventDefault();
                var serviceContainer = document.getElementById("serviceContainer");
                try{
                    showServices(findService(serviceContainer.firstElementChild.dataset.parent_id).PARENT_ID);
                }catch{
                    showServices(this.dataset.target);
                }
                return false;
            }
            return false;
        })

    </script>
    <?php
}    
?>