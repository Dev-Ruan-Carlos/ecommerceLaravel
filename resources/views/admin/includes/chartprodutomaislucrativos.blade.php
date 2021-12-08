<div class="chart-card mr-05">
    <h4 style="font-size: 23px;">Produtos mais lucrativos</h4>
    <span id="totalProdutosMaisLucrativos" class="d-none">0</span>
    <div class="parent-charts">
        <canvas id="chartProdutosMaisLucrativos" class="d-none"></canvas>
        <div id="semProdutosMaisLucrativos" class="d-none"><span></span></div>
    </div>
</div>
<script>
    window.addEventListener('load', function(){
        getProdutosMaisLucrativos();
    });

    var 
        totalProdutosMaisLucrativos = document.getElementById('totalProdutosMaisLucrativos'),
        chartProdutosMaisLucrativos = document.getElementById('chartProdutosMaisLucrativos').getContext('2d'),
        chartProdutosMaisLucrativos = new Chart(chartProdutosMaisLucrativos, {
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

                            return 'Valor total: ' + formatar(currentValue) + ' ('+Math.round(percentage) + '%)';
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
                            total   = document.getElementById('totalProdutosMaisLucrativos').textContent;

                        total = total;

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
                                    text: label + " : " + formatar(value) + ' ('+Math.round(percentage) + '%)',
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
    
    function getProdutosMaisLucrativos() {
        var
            semProdutosMaisLucrativos          = document.getElementById('semProdutosMaisLucrativos');

        $.ajax({
            url: "{{ route('admin.gerencial.chartprodutomaislucrativos') }}",
            type: 'GET',            
            beforeSend: function() {
                document.getElementById('chartProdutosMaisLucrativos').classList.add('d-none');
                semProdutosMaisLucrativos.classList.add('flex');
                semProdutosMaisLucrativos.classList.remove('d-none');
                semProdutosMaisLucrativos.querySelector("span").innerHTML = '<strong><h4 class="flex-ac">Carregando informação <i class="ml-05 fas spinner"></i></h4></strong>';
            },
            error: function(){
                semProdutosMaisLucrativos.classList.add('flex');
                semProdutosMaisLucrativos.classList.remove("d-none");
                semProdutosMaisLucrativos.querySelector("span").innerHTML = '<strong><h4>Não há informações a serem mostradas</h4></strong>';
            }  
        }).done(function(response){
            if (!response.status) {
                semProdutosMaisLucrativos.classList.remove('flex');
                semProdutosMaisLucrativos.classList.add('d-none');
                semProdutosMaisLucrativos.querySelector("span").innerHTML = '';
                document.getElementById('chartProdutosMaisLucrativos').classList.remove("d-none");

                chartProdutosMaisLucrativos.data.labels.pop();
                chartProdutosMaisLucrativos.data.labels = response.labels;

                chartProdutosMaisLucrativos.data.datasets[0].backgroundColor.pop();
                chartProdutosMaisLucrativos.data.datasets[0].backgroundColor = response.colors;

                chartProdutosMaisLucrativos.data.datasets[0].data.pop();
                if(response.dados && response.dados.length > 0)
                    chartProdutosMaisLucrativos.data.datasets[0].data = response.dados;
                    
                if(response.total)
                    totalProdutosMaisLucrativos.textContent = response.total;

                chartProdutosMaisLucrativos.update();                        
            } else {
                document.getElementById('chartProdutosMaisLucrativos').classList.add("d-none");
                semProdutosMaisLucrativos.classList.add('flex');
                semProdutosMaisLucrativos.classList.remove("d-none");
                semProdutosMaisLucrativos.querySelector("span").innerHTML = '<strong><h4>' + response.message + '</h4></strong>';                        
            }
        })       
    }
    
</script>