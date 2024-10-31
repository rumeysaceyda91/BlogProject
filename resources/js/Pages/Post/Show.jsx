import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import TextAreaInput from "@/Components/TextAreaInput";

export default function Show({auth,post}) {

    return (
        <AuthenticatedLayout
        user={auth.user}
        header={
          <div className="flex justify-between items-center">
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
              Post Detail
            </h2>
          </div>
        }
      >
       
            <Head title={`Post ${post.title}`} />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form
                    className="p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                    > 
                        <div className="mt-4">
                            <InputLabel htmlFor="title" value="Post Title" />

                            <TextInput
                            id="title"
                            type="text"
                            name="title"
                            value={post.title}
                            className="mt-1 block w-full"
                            disabled
                            />

                        </div>
                        <div className="mt-4">
                            <InputLabel
                            htmlFor="Content"
                            value="Content"
                            />

                            <TextAreaInput
                            id="content"
                            name="content"
                            value={post.content}
                            className="mt-1 block w-full"
                            disabled
                            />

                        </div>
                    </form>
                </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
