<template>
  <InlineSelectEditableValue :field="field" :resourceName="resourceName" />
</template>

<script>
import InlineSelectEditableValue from './InlineSelectEditableValue';

export default {
  components: { InlineSelectEditableValue },
  props: ['resourceName', 'field'],
};
</script>
