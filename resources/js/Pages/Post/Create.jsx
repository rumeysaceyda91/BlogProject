import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import TextAreaInput from "@/Components/TextAreaInput";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useForm } from '@inertiajs/react';

export default function Create({auth}) {
    const { data, setData, post, errors } = useForm({
        title: '',
        content: ''
    });

    const onSubmit = (e) => {
        e.preventDefault();

        post(route("post.store"));
    };

    return (
        <AuthenticatedLayout
        user={auth.user}
        header={
          <div className="flex justify-between items-center">
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
              Create new Post
            </h2>
          </div>
        }
      >
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form
                    onSubmit={onSubmit}
                    className="p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                    > 
                        <div className="mt-4">
                            <InputLabel htmlFor="title" value="Post Title" />

                            <TextInput
                            id="title"
                            type="text"
                            name="title"
                            value={data.title}
                            className="mt-1 block w-full"
                            isFocused={true}
                            onChange={(e) => setData("title", e.target.value)}
                            />

                            <InputError message={errors.title} className="mt-2" />
                        </div>
                        <div className="mt-4">
                            <InputLabel
                            htmlFor="Content"
                            value="Content"
                            />

                            <TextAreaInput
                            id="content"
                            name="content"
                            value={data.content}
                            className="mt-1 block w-full"
                            onChange={(e) => setData("content", e.target.value)}
                            />

                            <InputError message={errors.content} className="mt-2" />
                        </div>
                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600">
                            Submit
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
