return (
    <>
        <div className="accountContainer">
            <div
                className="accountBox"
                style={{
                    filter: "drop-shadow(4px 4px 2px rgba(0, 0, 0, 0.5))",
                }}
            >
                <div className="flexContainer">
                    <div className="profileContainer">
                        <div className="profileImage">
                            <Image
                                className="imageAccount"
                                priority={true}
                                src="https://avatars.githubusercontent.com/u/115600378?v=4"
                                alt="Profile Picture"
                                width={128}
                                height={128}
                            />
                        </div>
                        {userData.userProfile.map((profile, index) => {
                            return React.createElement(
                                profile.type,
                                {
                                    key: index,
                                    className: profile.className,
                                },
                                profile.text
                            );
                        })}
                        <div className="borderLine"></div>
                        <div className="infoContainer">
                            {userData.userInfo.map((info, index) => (
                                <div key={index} className="infoItem">
                                    <span className="text-gray-200">
                                        {info.label}
                                    </span>
                                    <span className="text-gray-200">
                                        {info.value}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>
                    <div className="buttonContainer">
                        <Link href="/">
                            <button className="backButton">Back</button>
                        </Link>
                        <Link href="/account/editprofile">
                            <button className="editButton">Edit Profile</button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </>
);
