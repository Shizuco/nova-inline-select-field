import IndexField from './components/IndexField';
import DetailField from './components/DetailField';

Nova.booting((Vue, router) => {
  Vue.component('index-inline-select-field', IndexField);
  Vue.component('detail-inline-select-field', DetailField);
});
