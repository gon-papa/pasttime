import { mount } from '@vue/test-utils'
import Login from '@/pages/admin/login.vue'

describe('ログイン正常系', () => {
    const mockRouterPush = {
        push: jest.fn()
    }
    const wrapper = mount(Login, {
        mocks: {
            $router: mockRouterPush
        }
    });
    test('ユーザー名入力欄が存在すること', () => {
        expect(wrapper.text()).toMatch('ユーザー名');
        const loginInput = wrapper.findComponent('.login-input');
        expect(loginInput.exists()).toBe(true);
    });
    test('パスワード入力欄が存在すること', () => {
        expect(wrapper.text()).toMatch('パスワード');
        const passInput = wrapper.findComponent('.password-input');
        expect(passInput.exists()).toBe(true);
    });
    test('サブミットが存在すること', () => {
        const submit = wrapper.findComponent('.login-submit');
        expect(submit.exists()).toBe(true);
        expect(submit.findComponent('span').text()).toMatch('ログイン');
    });
    test('正常にユーザー名とパスワードを入力後、サブミットしたらダッシュボードへ遷移する', () => {
        const submit = wrapper.findComponent('form');
        wrapper.findComponent('.login-input input').setValue('userName');
        wrapper.findComponent('.password-input input').setValue('secret');
        submit.trigger('submit.prevent');
        expect(mockRouterPush.push).toHaveBeenCalledWith('/admin/dashboard');
    });
    //バリデーションが効かないことのテスト
});

describe('ログイン異常系', () => {
    const wrapper = mount(Login);

    test('ユーザー名が空白ならエラー出力のこと', done => {
        const submit = wrapper.findComponent('form');
        wrapper.findComponent('.login-input input').setValue('');
        submit.trigger('submit.prevent');
        setTimeout(() => {
            expect(wrapper.text()).toMatch('name is required');
            done()
        })
    });
    test('パスワードが空白ならエラー出力のこと', done => {
        const submit = wrapper.findComponent('form');
        wrapper.findComponent('.password-input input').setValue('');
        submit.trigger('submit.prevent');
        setTimeout(() => {
            expect(wrapper.text()).toMatch('password is required');
            done()
        })
    });
    test('パスワードが5桁以下ならエラー出力のこと', done => {
        const submit = wrapper.findComponent('form');
        wrapper.findComponent('.password-input input').setValue('12345');
        submit.trigger('submit.prevent');
        setTimeout(() => {
            expect(wrapper.text()).toMatch('password must be between 6 and 12 characters');
            done()
        })
    });
    test('パスワードが13桁以上ならエラー出力のこと', done => {
        const submit = wrapper.findComponent('form');
        wrapper.findComponent('.password-input input').setValue('12345');
        submit.trigger('submit.prevent');
        setTimeout(() => {
            expect(wrapper.text()).toMatch('password must be between 6 and 12 characters');
            done()
        })
    });
});

// data-test-id="test-target"
//バリデーションテスト
//dataの確認
//フォームの送信作
//フォームに送るデータ
//サーバーからの失敗時の挙動