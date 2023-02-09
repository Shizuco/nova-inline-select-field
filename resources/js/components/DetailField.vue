<template>
  <PanelItem :field="field">
    <template #value>
      <InlineSelectEditableValue :field="field" :resourceName="resourceName" />
    </template>
  </PanelItem>
</template>

<script>
import InlineSelectEditableValue from './InlineSelectEditableValue';

export default {
  components: { InlineSelectEditableValue },
  props: ['resource', 'resourceName', 'resourceId', 'field'],
};
</script>
