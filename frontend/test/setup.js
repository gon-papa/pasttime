import { config } from '@vue/test-utils'
import locales from '@/lang/ja.js'
import Vue from 'vue';
import Antd from 'ant-design-vue';

Vue.use(Antd);

// i18nのモックを追加
const i18nMock = (key) => locales[key];

const mocks = {
    $t: i18nMock,
}
config.mocks = mocks