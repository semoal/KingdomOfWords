{"filter":false,"title":"register_success.php","tooltip":"/register_success.php","undoManager":{"mark":54,"position":54,"stack":[[{"start":{"row":0,"column":0},"end":{"row":1,"column":0},"action":"insert","lines":["",""],"id":2}],[{"start":{"row":0,"column":0},"end":{"row":4,"column":2},"action":"insert","lines":["<?php ","include_once 'includes/db_connect.php';","include_once 'includes/functions.php';","sec_session_start();","?>"],"id":3}],[{"start":{"row":18,"column":97},"end":{"row":19,"column":0},"action":"insert","lines":["",""],"id":5},{"start":{"row":19,"column":0},"end":{"row":19,"column":6},"action":"insert","lines":["      "]}],[{"start":{"row":19,"column":6},"end":{"row":20,"column":0},"action":"insert","lines":["    <?php if (login_check($mysqli) == true) : ?>",""],"id":6}],[{"start":{"row":19,"column":6},"end":{"row":20,"column":0},"action":"remove","lines":["    <?php if (login_check($mysqli) == true) : ?>",""],"id":11}],[{"start":{"row":19,"column":5},"end":{"row":19,"column":6},"action":"remove","lines":[" "],"id":12}],[{"start":{"row":19,"column":4},"end":{"row":19,"column":5},"action":"remove","lines":[" "],"id":13}],[{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"remove","lines":["    "],"id":14}],[{"start":{"row":18,"column":97},"end":{"row":19,"column":0},"action":"remove","lines":["",""],"id":15}],[{"start":{"row":24,"column":12},"end":{"row":25,"column":0},"action":"insert","lines":["",""],"id":16},{"start":{"row":25,"column":0},"end":{"row":25,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":25,"column":4},"end":{"row":26,"column":0},"action":"insert","lines":["    <?php if (login_check($mysqli) == true) : ?>",""],"id":17}],[{"start":{"row":25,"column":4},"end":{"row":25,"column":8},"action":"remove","lines":["    "],"id":18}],[{"start":{"row":25,"column":0},"end":{"row":25,"column":48},"action":"remove","lines":["    <?php if (login_check($mysqli) == true) : ?>"],"id":19}],[{"start":{"row":24,"column":12},"end":{"row":25,"column":0},"action":"remove","lines":["",""],"id":20}],[{"start":{"row":24,"column":12},"end":{"row":25,"column":0},"action":"remove","lines":["",""],"id":22}],[{"start":{"row":31,"column":64},"end":{"row":31,"column":114},"action":"insert","lines":["<?php echo htmlentities($_SESSION['username']); ?>"],"id":26}],[{"start":{"row":31,"column":114},"end":{"row":31,"column":115},"action":"insert","lines":[" "],"id":27}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"insert","lines":["/"],"id":28}],[{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"insert","lines":["*"],"id":29}],[{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"remove","lines":["*"],"id":30}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"remove","lines":["/"],"id":31}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"insert","lines":["<"],"id":32}],[{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"insert","lines":["!"],"id":33}],[{"start":{"row":0,"column":2},"end":{"row":0,"column":3},"action":"insert","lines":["-"],"id":34}],[{"start":{"row":0,"column":3},"end":{"row":0,"column":4},"action":"insert","lines":["-"],"id":35}],[{"start":{"row":0,"column":3},"end":{"row":0,"column":4},"action":"remove","lines":["-"],"id":52}],[{"start":{"row":0,"column":2},"end":{"row":0,"column":3},"action":"remove","lines":["-"],"id":53}],[{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"remove","lines":["!"],"id":54}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"remove","lines":["<"],"id":55}],[{"start":{"row":18,"column":97},"end":{"row":19,"column":0},"action":"insert","lines":["",""],"id":56},{"start":{"row":19,"column":0},"end":{"row":19,"column":6},"action":"insert","lines":["      "]}],[{"start":{"row":19,"column":6},"end":{"row":20,"column":0},"action":"insert","lines":["    <?php if (login_check($mysqli) == true) : ?>",""],"id":57}],[{"start":{"row":19,"column":8},"end":{"row":19,"column":9},"action":"remove","lines":[" "],"id":58}],[{"start":{"row":19,"column":8},"end":{"row":19,"column":9},"action":"remove","lines":[" "],"id":59}],[{"start":{"row":19,"column":4},"end":{"row":19,"column":8},"action":"remove","lines":["    "],"id":60}],[{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"remove","lines":["    "],"id":61}],[{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "],"id":62}],[{"start":{"row":19,"column":4},"end":{"row":19,"column":8},"action":"insert","lines":["    "],"id":63}],[{"start":{"row":19,"column":4},"end":{"row":19,"column":8},"action":"remove","lines":["    "],"id":64}],[{"start":{"row":19,"column":4},"end":{"row":19,"column":5},"action":"insert","lines":[" "],"id":65}],[{"start":{"row":19,"column":5},"end":{"row":19,"column":6},"action":"insert","lines":[" "],"id":66}],[{"start":{"row":19,"column":50},"end":{"row":20,"column":0},"action":"remove","lines":["",""],"id":67}],[{"start":{"row":40,"column":0},"end":{"row":44,"column":23},"action":"insert","lines":["        <?php else : ?>","            <p>","                <span class=\"error\">No estas autorizado para entrar en este apartado</span> Por favor <a href=\"index.php\">inicia sesión</a>.","            </p>","        <?php endif; ?>"],"id":68}],[{"start":{"row":19,"column":40},"end":{"row":19,"column":44},"action":"remove","lines":["true"],"id":87},{"start":{"row":19,"column":40},"end":{"row":19,"column":41},"action":"insert","lines":["f"]}],[{"start":{"row":19,"column":41},"end":{"row":19,"column":42},"action":"insert","lines":["a"],"id":88}],[{"start":{"row":19,"column":42},"end":{"row":19,"column":43},"action":"insert","lines":["l"],"id":89}],[{"start":{"row":19,"column":43},"end":{"row":19,"column":44},"action":"insert","lines":["s"],"id":90}],[{"start":{"row":19,"column":44},"end":{"row":19,"column":45},"action":"insert","lines":["e"],"id":91}],[{"start":{"row":19,"column":0},"end":{"row":20,"column":0},"action":"remove","lines":["      <?php if (login_check($mysqli) == false) : ?>",""],"id":92}],[{"start":{"row":39,"column":0},"end":{"row":40,"column":0},"action":"remove","lines":["        <?php else : ?>",""],"id":93}],[{"start":{"row":42,"column":0},"end":{"row":43,"column":0},"action":"remove","lines":["        <?php endif; ?>",""],"id":94}],[{"start":{"row":39,"column":0},"end":{"row":41,"column":16},"action":"remove","lines":["            <p>","                <span class=\"error\">No estas autorizado para entrar en este apartado</span> Por favor <a href=\"index.php\">inicia sesión</a>.","            </p>"],"id":95}],[{"start":{"row":38,"column":14},"end":{"row":39,"column":0},"action":"remove","lines":["",""],"id":96}],[{"start":{"row":31,"column":64},"end":{"row":31,"column":115},"action":"remove","lines":["<?php echo htmlentities($_SESSION['username']); ?> "],"id":97}],[{"start":{"row":0,"column":0},"end":{"row":4,"column":2},"action":"remove","lines":["<?php ","include_once 'includes/db_connect.php';","include_once 'includes/functions.php';","sec_session_start();","?>"],"id":98}],[{"start":{"row":0,"column":0},"end":{"row":1,"column":0},"action":"remove","lines":["",""],"id":99}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":0,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1485910517329,"hash":"be488b69fb8e3da2a90d06e7d65d63120ca11861"}