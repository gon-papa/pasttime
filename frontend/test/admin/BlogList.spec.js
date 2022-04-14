import { shallowMount, RouterLinkStub } from '@vue/test-utils'
import BlogList from '@/pages/admin/BlogList'

const response = {
    "status": 200,
    "blogs": [
        {
            "id": 5,
            "user_id": 26,
            "title": "Prof.",
            "body": "Alice, as she spoke; 'either you or your head must be collected at once took up the little thing was snorting like a snout than a real nose; also its eyes again, to see if there are, nobody attends to them--and you've no idea how confusing it is I hate cats and dogs.' It was all dark overhead; before her was another long passage, and the Panther were sharing a pie--' [later editions continued as follows When the sands are all dry, he is gay as a last resource, she put them into a line along the sea-shore--' 'Two lines!' cried the Gryphon, 'she wants for to know when the tide rises and sharks are around, His voice has a timid voice at her as she could not join the dance. So they began moving about again, and we put a white one in by mistake; and if I know I have done that, you know,' said Alice in a low, timid voice, 'If you knew Time as well go back, and barking hoarsely all the right size to do it! Oh dear! I'd nearly forgotten to ask.' 'It turned into a conversation. 'You don't.",
            "status": 1,
            "thummbnail": "\/storage\/images\/MyIcon.jpeg",
            "images_path": "[\".\\\/strage\\\/public\\\/image\\\/MyIcon.jpeg\"]",
            "created_at": "2022-03-24T14:16:18.000000Z",
            "updated_at": "2022-03-24T14:16:18.000000Z",
            "deleted_at": null
        },
        {
            "id": 6,
            "user_id": 26,
            "title": "Prof.",
            "body": "xafga",
            "status": 1,
            "thummbnail": "\/storage\/images\/MyIcon.jpeg",
            "images_path": "[\".\\\/strage\\\/public\\\/image\\\/MyIcon.jpeg\"]",
            "created_at": "2022-03-24T14:16:18.000000Z",
            "updated_at": "2022-03-24T14:16:18.000000Z",
            "deleted_at": null
        }
    ]
}

describe('ブログリストが正常に表示されている', () => {
    const init = jest.fn();
    init.mockReturnValue(response);
    const wrapper = shallowMount(BlogList, {
        stubs: {
            NuxtLink: RouterLinkStub,
        },
        methods: {
            init,
        },
        $config: {
            END_POINT: 'http://localhost'
        }
    });

    beforeAll(() => {
        return wrapper.vm.blogs = response.blogs;
    })

    test('ブログリストが表示されていること', () => {
        expect(wrapper.text()).toMatch('削除');
    })
})