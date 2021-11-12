<div class="chart-card">
    <h4>Produtos mais vendidos</h4>
    <span id="totalProdutosMaisVendidos" class="d-none">0</span>
    <div class="parent-charts">
        <canvas id="chartProdutosMaisVendidos" class="d-none"></canvas>
        <div id="semProdutosMaisVendidos" class="d-none h-100 flex-jc flex-ac"><span></span></div>
    </div>
</div>
<script>
    window.addEventListener('load', function(){
        getProdutosMaisVendidos();
    });

    var 
        totalProdutosMaisVendidos = document.getElementById('totalProdutosMaisVendidos'),
        chartProdutosMaisVendidos = document.getElementById('chartProdutosMaisVendidos').getContext('2d'),
        chartProdutosMaisVendidos = new Chart(chartProdutosMaisVendidos, {
        type: 'pie',
        data: {
            labels: [],
            datasets: [
                {
                    data: [],
                    backgroundColor: [],
                    hoverOffset: 4
                },
            ], 
        }, 
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var 
                            dataset = data.datasets[tooltipItem.datasetIndex],
                            meta = dataset._meta[Object.keys(dataset._meta)[0]],
                            total = meta.total,
                            currentValue = dataset.data[tooltipItem.index],
                            percentage = parseFloat((currentValue/total*100).toFixed(2));

                            return 'Qtde total: ' + parseInt(currentValue) + ' ('+Math.round(percentage) + '%)';
                    },
                    title: function(tooltipItem, data) {
                        return data.labels[tooltipItem[0].index];
                    }
                }
            },   
            legend: {
                fontSize: 12,
                position: 'left',
                labels: {
                    generateLabels: function(chart) {
                        var 
                            data    = chart.data,
                            total   = document.getElementById('totalProdutosMaisVendidos').textContent;

                        total = parseInt(total);

                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map(function(label, i) {
                                var 
                                    meta                        = chart.getDatasetMeta(0),
                                    ds                          = data.datasets[0],
                                    arc                         = meta.data[i],
                                    custom                      = arc && arc.custom || {},
                                    getValueAtIndexOrDefault    = Chart.helpers.getValueAtIndexOrDefault,
                                    arcOpts                     = chart.options.elements.arc,
                                    fill                        = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor),
                                    stroke                      = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor),
                                    bw                          = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth),
                                    value                       = chart.config.data.datasets[arc._datasetIndex].data[arc._index],
                                    dataset                     = data.datasets[i],
                                    percentage                  = parseFloat((value/total*100).toFixed(2));

                                return {
                                    text: label + " : " + parseInt(value) + ' ('+Math.round(percentage) + '%)',
                                    fillStyle: fill,
                                    strokeStyle: stroke,
                                    lineWidth: bw,
                                    hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                                    index: i
                                };
                            });
                        } else {
                            return [];
                        }
                    }
                }
            }                              
        }   
    });

    
    function getProdutosMaisVendidos() {
        var
            semProdutosMaisVendidos          = document.getElementById('semProdutosMaisVendidos');

        $.ajax({
            url: "{{ route('admin.gerencial.chartprodutomaisvendidos') }}",
            type: 'GET',            
            beforeSend: function() {
                document.getElementById('chartProdutosMaisVendidos').classList.add('d-none');
                semProdutosMaisVendidos.classList.add('flex');
                semProdutosMaisVendidos.classList.remove('d-none');
                semProdutosMaisVendidos.querySelector("span").innerHTML = '<strong><h4 class="flex-ac">Carregando informação <i class="ml-05 fas spinner"></i></h4></strong>';
            },
            error: function(){
                semProdutosMaisVendidos.classList.add('flex');
                semProdutosMaisVendidos.classList.remove("d-none");
                semProdutosMaisVendidos.querySelector("span").innerHTML = '<strong><h4>Não há informações a serem mostradas</h4></strong>';
            }  
        }).done(function(response){
            if (!response.status) {
                semProdutosMaisVendidos.classList.remove('flex');
                semProdutosMaisVendidos.classList.add('d-none');
                semProdutosMaisVendidos.querySelector("span").innerHTML = '';
                document.getElementById('chartProdutosMaisVendidos').classList.remove("d-none");

                chartProdutosMaisVendidos.data.labels.pop();
                chartProdutosMaisVendidos.data.labels = response.labels;

                chartProdutosMaisVendidos.data.datasets[0].backgroundColor.pop();
                chartProdutosMaisVendidos.data.datasets[0].backgroundColor = response.colors;

                chartProdutosMaisVendidos.data.datasets[0].data.pop();
                if(response.dados && response.dados.length > 0)
                    chartProdutosMaisVendidos.data.datasets[0].data = response.dados;
                    
                if(response.total)
                    totalProdutosMaisVendidos.textContent = response.total;

                chartProdutosMaisVendidos.update();                        
            } else {
                document.getElementById('chartProdutosMaisVendidos').classList.add("d-none");
                semProdutosMaisVendidos.classList.add('flex');
                semProdutosMaisVendidos.classList.remove("d-none");
                semProdutosMaisVendidos.querySelector("span").innerHTML = '<strong><h4>' + response.message + '</h4></strong>';                        
            }
        })       
    }
    
</script>