<script>
    var lista = [
            { "desc": "rice", "amount": "1", "value": "5.40" },
            { "desc": "beer", "amount": "12", "value": "1.99" },
            { "desc": "meat", "amount": "1", "value": "15.00" }
        ]

        function getTotal(lista) {
            var total = 0;
            for (var key in lista) {
                total += lista[key].value * lista[key].amount;
            }
            document.getElementById("totalValue").innerHTML = formatValue(total);
        }

        function setList(lista) {
            var table = '<thead><tr><td>Descrição</td><td>Quantidade</td><td>Valor</td><td>Ação</td></tr></thead><tbody>';
            for (var key in lista) {
                table += '<tr><td>' + formatDesc(lista[key].desc) + '</td><td>' + formatAmount(lista[key].amount) + '</td><td>' + formatValue(lista[key].value) + '</td><td><button onclick="setUpdate(' + key + ')" class="btn btn-info">Edit</button> <button onclick="deleteData(' + key + ')" class="btn btn-danger">Delete</button> </td></tr>';
            }
            table += '</tbody>';
            document.getElementById("listTable").innerHTML = table;
            getTotal(lista);
            savelistStorage(lista)
        }

        function formatDesc(desc) {
            var str = desc.toLowerCase();
            str = str.charAt(0).toUpperCase() + str.slice(1);
            return str;
        }

        function formatAmount(amount) {
            return parseInt(amount);

        }

        function formatValue(value) {
            var str = parseFloat(value).toFixed(2) + "";
            str = str.replace(".", ",");
            str = "$ " + str;
            return str;

        }

        function addData() {
            if (!validation()) {
                return;
            }
            var desc = document.getElementById("desc").value;
            var amount = document.getElementById("amount").value;
            var value = document.getElementById("value").value;

            lista.unshift({ "desc": desc, "amount": amount, "value": value });
            setList(lista);
        }

        function setUpdate(id) {
            var obj = lista[id];
            document.getElementById("desc").value = obj.desc;
            document.getElementById("amount").value = obj.amount;
            document.getElementById("value").value = obj.value;
            document.getElementById("btnUpdate").style.display = "inline-block";
            document.getElementById("btnAdd").style.display = "none";
            document.getElementById("inputIdUpdate").innerHTML = '<input id="idUpdate" type="hidden" value = "' + id + '">';
        }

        function resetForm() {
            document.getElementById("desc").value = "";
            document.getElementById("amount").value = "";
            document.getElementById("value").value = "";
            document.getElementById("btnUpdate").style.display = "none";
            document.getElementById("btnAdd").style.display = "inline-block";
            document.getElementById("inputIdUpdate").innerHTML = "";
            document.getElementById("errors").style.display = "none";
        }

        function updateForm() {
            if (!validation()) {
                return;
            }
            var id = document.getElementById("idUpdate").value;
            var desc = document.getElementById("desc").value;
            var amount = document.getElementById("amount").value;
            var value = document.getElementById("value").value;

            lista[id] = { "desc": desc, "amount": amount, "value": value };
            resetForm();
            setList(lista);

        }

        function deleteData(id) {
            if (confirm("Deseja apagar este item?")) {
                if (id === lista.length - 1) {
                    lista.pop();

                } else if (id === 0) {
                    lista.shift();
                } else {
                    var arrAuxIni = lista.slice(0, id);
                    var arrAuxEnd = lista.slice(id + 1);
                    lista = arrAuxIni.concat(arrAuxEnd);
                }
                setList(lista);
            }
        }

        function validation() {
            var desc = document.getElementById("desc").value;
            var amount = document.getElementById("amount").value;
            var value = document.getElementById("value").value;
            var errors = "";
            document.getElementById("errors").style.display = "none";

            if (desc === "") {
                errors += '<p>Insira uma descrição</p>';
            }
            if (amount === "") {
                errors += '<p>Insira uma quantidade</p>';
            } else if (amount != parseInt(amount)) {
                errors += '<p>Insira um valor de quantidade válido</p>';
            }
            if (value === "") {
                errors += '<p>Insira um valor</p>';
            } else if (value != parseFloat(value)) {
                errors += '<p>Insira um valor correto</p>';
            }
            if (errors != "") {
                document.getElementById("errors").style.display = "block";
                document.getElementById("errors").style.backgroundColor = "#eee"
                document.getElementById("errors").style.color = "black"
                document.getElementById("errors").style.padding = "10px"
                document.getElementById("errors").style.margin = "10px"
                document.getElementById("errors").style.borderRadius = "13px"

                document.getElementById("errors").innerHTML = "<h3>Erro:</h3>" + errors;
                return 0;
            } else {
                return 1;
            }
        }

        function deleteLista() {
            if (confirm("Deseja apagar todos os regitros?")) {
                lista = [];
                setList(lista);
            }
        }

        function savelistStorage(lista) {
            var jsonStr = JSON.stringify(lista);
            localStorage.setItem("lista", jsonStr);

        }

        function initlistStorage() {
            var testList = localStorage.getItem("lista");
            if (testList) {
                lista = JSON.parse(testList);
            }
            setList(lista);
        }


        initlistStorage()
</script>
    