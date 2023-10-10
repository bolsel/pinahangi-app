import Chart from 'chart.js/auto';
import colors from "tailwindcss/colors";
import _ from 'lodash'

window.Chart = Chart;
const getOrCreateLegendList = (chart, id) => {
  const legendContainer = document.getElementById(id);
  let listContainer = legendContainer.querySelector('ul');
  if (!listContainer) {
    listContainer = document.createElement('ul');
    listContainer.className = ('flex flex-col')
    legendContainer.appendChild(listContainer);
  }
  return listContainer;
};
/**
 *
 * @type {import('chart.js/auto').Plugin}
 */
const htmlLegendPlugin = {
  id: 'htmlLegend',
  afterUpdate(chart, args, options) {

    const ul = getOrCreateLegendList(chart, options.containerID);

    // Remove old legend items
    while (ul.firstChild) {
      ul.firstChild.remove();
    }

    // Reuse the built-in legendItems generator
    const items = chart.options.plugins.legend.labels.generateLabels(chart);

    items.forEach(item => {
      const li = document.createElement('li');
      li.className = 'hover:bg-base-200 px-1 rounded-lg'
      li.style.alignItems = 'center';
      li.style.cursor = 'pointer';
      li.style.display = 'flex';
      li.style.flexDirection = 'row';
      li.style.marginLeft = '10px';

      li.onclick = () => {
        const {type} = chart.config;
        if (type === 'pie' || type === 'doughnut') {
          // Pie and doughnut charts only have a single dataset and visibility is per item
          chart.toggleDataVisibility(item.index);
        } else {
          chart.setDatasetVisibility(item.datasetIndex, !chart.isDatasetVisible(item.datasetIndex));
        }
        chart.update();
      };

      // Color box
      const boxSpan = document.createElement('span');
      boxSpan.style.background = item.fillStyle;
      boxSpan.style.borderColor = item.strokeStyle;
      boxSpan.style.borderWidth = item.lineWidth + 'px';
      boxSpan.style.display = 'inline-block';
      boxSpan.style.flexShrink = 0;
      boxSpan.style.height = '20px';
      boxSpan.style.marginRight = '10px';
      boxSpan.style.width = '20px';
      boxSpan.className = 'rounded-md';

      // Text
      const textContainer = document.createElement('p');
      textContainer.style.color = item.fontColor;
      textContainer.style.margin = 0;
      textContainer.style.padding = 0;
      textContainer.style.textDecoration = item.hidden ? 'line-through' : '';

      const text = document.createTextNode(item.text);
      textContainer.appendChild(text);
      const dataValue = document.createElement('span')
      dataValue.className = 'font-medium ml-auto pl-5';
      dataValue.innerHTML = options.data[item.index] ?? ''
      li.appendChild(boxSpan);
      li.appendChild(textContainer);
      li.appendChild(dataValue);
      ul.appendChild(li);
    });
  }
};
window.ChartPieWithLegend = (el, data, legendContainer) => {
  new Chart(
    el,
    {
      type: 'pie',
      data: {
        labels: data.labels,
        datasets: [
          {
            data: data.data,
            label: 'Jumlah',
            backgroundColor: data.backgroundColor.map((value) => _.get(colors, value))
          }
        ]
      },
      options: {
        plugins: {
          htmlLegend: {
            containerID: legendContainer,
            data: data.data
          },
          legend: {
            display: false,
          },
          title: {
            display: false,
          }
        }
      },
      plugins: [htmlLegendPlugin]
    }
  );
}
