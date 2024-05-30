<button onclick="openContactPicker()">Open my phone contacts</button>

<script>
    function openContactPicker() {
        const supported = "contacts" in navigator && "ContactsManager" in window;

        if (supported) {
            getContacts();
        } else {
            alert(
                "Contact list API not supported!. Only for android mobile chrome and chrome version > 80"
            );
        }
    }
    async function getContacts() {
        const props = ["name", "tel"];
        const opts = {
            multiple: false
        };

        try {
            const contacts = await navigator.contacts.select(props, opts);
            alert(JSON.stringify(contacts));
        } catch (err) {
            alert(err);
        }
    }
</script>