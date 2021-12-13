import React, { useState,useEffect } from 'react';
import { render } from 'react-dom';
import HighchartsReact from 'highcharts-react-official';
import Highcharts from 'highcharts';

const LineChart = () => {
  const [hoverData, setHoverData] = useState(null);
  const [chartOptions, setChartOptions] = useState({
    title: false,
    subtitle: false,
    tooltip: { enabled: false },
    xAxis: {
      categories: [''],
      title: {
          text: null
      },
      labels: {
       enabled:false,//default is true
       y : 20, rotation: -45, align: 'right' }
  },
    series: [
      { data: [], name: 'Pulso cardiaco' }
    ],
    yAxis: {
        title: {
            text: ''
        }
    },
    plotOptions: {
        series: {
          label: {
            connectorAllowed: false
        },
          marker: {
            enabled: false
          },
          states: {
            hover: {
                enabled: false
            }
        }
        }
      }
  });

  const updateSeries =async () => {
    const response = await fetch('/api/pulsos-v');
    const {data} = await response.json();
    //const responsex = await fetch('/generar');
    setChartOptions({ 
      series: [
          { data: data,}
        ]
    });
  }

  useEffect(() => {
    const interval = setInterval(() => {
      updateSeries()
    }, 1000);
    return () => clearInterval(interval);
  }, []);

  return (
      <div style={{ height:'100%', width:'100%', position:'absolute' }}>
        <HighchartsReact
          highcharts={Highcharts}
          options={chartOptions}
        />
      </div>
    )
}

export default LineChart;