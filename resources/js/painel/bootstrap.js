import _ from "lodash";
import * as bootstrap from "bootstrap";
import jQuery from "jquery";
import DataTable from "datatables.net-bs5";
import DataTableResponsive from "datatables.net-responsive-bs5";
import "boxicons";
import axios from "axios";

Object.assign(window, {
    _,
    bootstrap,
    jQuery,
    $: jQuery
});

DataTable();
DataTableResponsive();

Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    .map(el => new bootstrap.Tooltip(el));

/**
 * We"ll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo";

// import Pusher from "pusher-js";
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
//     enabledTransports: ["ws", "wss"],
// });

// $.extend($.fn.dataTable.defaults, {
//     language: {
//       sEmptyTable: "Nenhum registro encontrado",
//       sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
//       sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
//       sInfoFiltered: "(Filtrados de _MAX_ registros)",
//       sInfoThousands: ".",
//       sLengthMenu: "_MENU_ resultados por página",
//       sLoadingRecords: "Carregando...",
//       sProcessing: "Processando...",
//       sZeroRecords: "Nenhum registro encontrado",
//       sSearch: "Pesquisar",
//       oPaginate: {
//         sNext: "Próximo",
//         sPrevious: "Anterior",
//         sFirst: "Primeiro",
//         sLast: "Último"
//       },
//       oAria: {
//         sSortAscending: ": Ordenar colunas de forma ascendente",
//         sSortDescending: ": Ordenar colunas de forma descendente"
//       },
//       select: {
//         rows: {
//           "_": "Selecionado %d linhas",
//           "0": "Nenhuma linha selecionada",
//           "1": "Selecionado 1 linha"
//         }
//       },
//       buttons: {
//         copy: "Copiar para a área de transferência",
//         copyTitle: "Cópia bem sucedida",
//         copySuccess: {
//           "1": "Uma linha copiada com sucesso",
//           "_": "%d linhas copiadas com sucesso"
//         }
//       }
//     }
// });
